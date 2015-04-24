<?php
session_start();
//Login automatically if a session already exists
if(isset($_SESSION["gen_id"]))
{
	require("Database/sql_con.php");
	$gen_id = substr($_SESSION["gen_id"],0,-10);
	$stmt = $mysqli->prepare("SELECT * FROM `login` WHERE md5(`gen_id`)=? ");
	$stmt->bind_param("i", $gen_id);	
	if($stmt->execute())
	{
		if($rs = $stmt->get_result())
		{
			$count = mysqli_num_rows($rs);
			while ($arr = mysqli_fetch_array($rs)) 
			{
				$gen_id_db = md5($arr["gen_id"]);		
			}
			if(($count==1&&$gen_id!=""&&strcmp($gen_id,$gen_id_db)==0))
			{
				header("location:home.php");
			}
		}
	}
	mysqli_close($mysqli);
}
//Login automatically if "Remember Me" has been choosen
else if (isset($_COOKIE['cow']) && isset($_COOKIE['calf'])) 
{
	require("Database/sql_con.php");
	$uname = substr($_COOKIE['cow'],0,-10); 
	$gen_id = substr($_COOKIE['calf'],0,-10);
	$stmt = $mysqli->prepare("SELECT * FROM `login` WHERE md5(`uid`)=?  AND md5(`gen_id`)=?");
	$stmt->bind_param("ss", $uname, $gen_id);	
	$uname_db="";
	$gen_id_db="";
	$salt = "pswqghniaz";
	if($stmt->execute())
	{
		if($rs = $stmt->get_result())
		{
			$count = mysqli_num_rows($rs);
			while ($arr = mysqli_fetch_array($rs)) 
			{
				$uname_db = md5($arr["uid"]);
				$gen_id_db = md5($arr["gen_id"]);		
			}
			if(($count==1&&$uname!=""&&$gen_id!=""&&strcmp($uname,$uname_db)==0)&&(strcmp($gen_id,$gen_id_db)==0))
			{
				$_SESSION["gen_id"]=$gen_id_db.$salt;
				header("location:home.php");
			}
		}
	}
	mysqli_close($mysqli);
}

//When the user wants to login
if(isset($_POST["login"]))
{
	require("Database/sql_con.php");
	$uname=$_POST["uname_id"];
	$pword=$_POST["pword_id"];
	$stmt = $mysqli->prepare("SELECT * FROM `login` WHERE `uid`=?  AND `password`=?");
	$stmt->bind_param("ss", $uname, $pword);	
	$uname_db="";
	$pword_db="";
	if($stmt->execute())
	{
		if($rs = $stmt->get_result())
		{
			$count = mysqli_num_rows($rs);
			while ($arr = mysqli_fetch_array($rs)) 
			{
				$uname_db = $arr["uid"];
				$pword_db = $arr["password"];	
				$gen_id = $arr["gen_id"];		
			}
			if(($count==1&&$uname!=""&&$pword!=""&&strcmp($uname,$uname_db)==0)&&(strcmp($pword,$pword_db)==0))
			{
				$salt = "pswqghniaz";
				if (isset($_POST["save_login"]))
				{
						//Cookie to be created for auto login when "Remember me" has been chosen and the saved id and password expires in 60 days
						setcookie('cow',md5($uname_db).$salt,time()+3600*24*60);
						setcookie('calf',md5($gen_id).$salt,time()+3600*24*60);
				}
				$_SESSION["gen_id"]=md5($gen_id).$salt;
				header("location:home.php");
			}
			else
			{
				echo '<script>toast("Incorrect Username/Password", 3000, "#e53935 red darken-1");</script>';
			}
		}
		else
			echo"Result set not fetched mysqli_error()";
	}
	else
		echo "Query not executed mysqli_error()";
mysqli_close($mysqli);
}

//forgot_password
else if(isset($_POST["get_password"]))
{
	require("Database/sql_con.php");
	
	$email_f = $_POST["email_forgot"];
	$regno_f = $_POST["regno_forgot"];
	
	$gen_id_db ="";
	$regno_db="";
	$email_db="";
	
	$stmt = $mysqli->prepare("SELECT `gen_id`, `regno`, `email` FROM `info_user` WHERE `email`=? AND `regno`=? ");
	$stmt->bind_param("ss", $email_f,$regno_f);	
	if($stmt->execute())
	{
		if($rs = $stmt->get_result())
		{
			$count = mysqli_num_rows($rs);
			while ($arr = mysqli_fetch_array($rs)) 
			{
				$email_db =  $arr["email"];
				$regno_db = $arr["regno"];
				$gen_id_db = $arr["gen_id"];		
			}
			if(($count==1&&$email_f!=""&&$regno_f!=""&&strcmp($email_f,$email_db)==0)&&(strcmp($regno_f,$regno_db)==0))
			{
				require("generate_hash.php");
				$ResultStr = generateHash();
				$activated=0;
				$date=date("Y-m-d");
				$stmt = $mysqli->prepare("INSERT INTO `forgot_password` ( `gen_id`, `hash`, `date_apply`, `email` ,`activated`) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("isssi", $gen_id_db, $ResultStr,$date,$email_db,$activated);	
				if($stmt->execute())
				{
					date_default_timezone_set('Asia/Calcutta');
					require 'mail/PHPMailerAutoload.php';
					//Create a new PHPMailer instance
					$mail = new PHPMailer();
					/*
					if($mail->smtpConnect())
					{
					*/
							$to= $email_db; 
							$subject= "Leminiscate | Password Reset" ;
							$message="Pls check this link  <a href='localhost/lemniscate/password_reset.php?p=$ResultStr&e=$email_db&d=$date'>Link</a> ";
							//Tell PHPMailer to use SMTP
							$mail->isSMTP();

							//Enable SMTP debugging
							$mail->SMTPDebug = 0;						
							$mail->Host = 'smtp.gmail.com';

							//Set the SMTP port number - 465 for authenticated TLS, a.k.a. RFC4409 SMTP submission
							$mail->Port =  587;

							//Set the encryption system to use - ssl (deprecated) or tls
							$mail->SMTPSecure = 'tls';

							//Whether to use SMTP authentication
							$mail->SMTPAuth = true;

							//Username to use for SMTP authentication - use full email address for gmail
							$mail->Username = "gdgriviera@gmail.com";

							//Password to use for SMTP authentication
							$mail->Password = "gdgriviera1";

							//Set who the message is to be sent from
							$mail->setFrom('gdgriviera@gmail.com', 'Leminiscate Verification');

							//Set an alternative reply-to address
							$mail->addReplyTo('gdgriviera@gmail.com', 'Leminiscate Verification');

							//Set who the message is to be sent to
							$mail->addAddress($to, 'Student');

							//Set the subject line
							$mail->Subject = $subject;

							//Replace the plain text body with one created manually
							$mail->Body = $message;

							//send the message, check for errors
							if (!$mail->send())
							{
								echo "Mailer Error: " . $mail->ErrorInfo;
							}
							else 
							{
								echo '<script>toast("Message sent! Check your mail for resetting your password", 3000, "#e53935 red darken-1");</script>';
							}
				/*
					}
					else
						echo "Mailer connection problem";
				*/
				}
				else
				{
					echo "Error in inserting the data into forget_passwords";	
				}
			}
		}
	}
	mysqli_close($mysqli);
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<title>Lemniscate | Login</title>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/materialize.css">


    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></SCRIPT>

</head>

<body class="bg-login">
	<div class="login-screen">
		<div class="panel-login blur-content">
			<h3 class="white-text hcenter" style="padding-top:10px;">Lemniscate</h3>

			<div id="pane-login" class="panel-body active">
				<div class="row">
                  <div class="col s12 tabln">
                    <ul class="tabs">
                      <li class="tab col s3"><a href="#tab1" class="active" onclick="hide1tab3();">Sign In</a></li>
                      <li class="tab col s3"><a href="#tab2" onclick="hide2tab3();">Sign Up</a></li>
                    </ul>
                  </div>
				  
				  
				  <!--login form-->
                  <!---Self PHP call which validates the user-->
				  <div id="tab1" class="col s12 tab1">

                                 <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input name="uname_id" id="uname_id" type="text" class="validate white-text" autocomplete="off">
                                      <label for="uname_id">Username</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input id="pword_id" name="pword_id" type="password" class="validate white-text" autocomplete="off">
                                      <label for="pword_id">Password</label>
                                    </div>
                                   <div class="remcheck col s12">
                                   	<input type="checkbox" id="save_login" name="save_login"checked />
                                      <label for="save_login">Remember Me</label>
                                   </div>
                                   <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	<button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="login" id="login">Login
                                        <i class="mdi-content-send right"></i>
                                      </button>
                                   </div>
                                 </div>
                                </form>
                  </div>

					<!--Registration form-->
                  <div id="tab2" class="col s12 tab2">
                                  
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_id" name="regno_id" type="text" class="validate white-text" autocomplete="off">
                                      <label for="regno_id">Registration Number</label>
                                    </div>
                                  
                                   <div class="input-field col s12">
                                      <input name="email_id" id="email_id" type="email" class="validate white-text" autocomplete="off">
                                      <label for="email_id">VIT Gmail-ID</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input name="p_no" id="p_no" type="text" class="validate white-text" autocomplete="off">
                                      <label for="p_no">Parent's Mobile Number</label>
                                    </div>
									<div class="input-field col s12">
                                      <input name="mobno" id="mobno" type="text" class="validate white-text" autocomplete="off" maxlength="10" onkeypress='return isNumber(event)' >
                                      <label for="mobno"> Parent Mobile no</label>
                                    </div>
                                    <div class="input-field col s12">
                                    <label for="dob">Birthday</label>
                                    <input name="dob" id="dob" type="date" class="datepicker white-text">
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	   <button class="btn waves-effect waves-light #03a9f4 light-blue"  onclick="register();" id = "register" name="register">Sign Up
                                        <i class="mdi-social-person-add right"></i>
                                      </button>
                                   </div>
                                   </div>
                                
                  </div>
                  <div class="col s12" id="fwpd" style="text-align:center;">
                  <a class="waves-effect waves-light btn-flat tab3 white-text" onclick="showtab3();">Forgot Password?</a>
                  </div>
                  <div id="tab3" class="col s12 tab3c">
                                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
								  <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_forgot" name="regno_forgot" type="text" class="validate white-text" autocomplete="off">
                                      <label for="regno_forgot">Registration Number</label>
                                    </div>
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="email_forgot"  name="email_forgot" type="email" class="validate white-text" autocomplete="off">
                                      <label for="email_forgot">Email ID</label>
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                       <button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="get_password" name="get_password">Get Password
                                        <i class="mdi-action-get-app right"></i>
                                      </button>
                                   </div></div>
                                </form>
                                <div class="col s12" style="text-align:center;">
                                <a class="waves-effect waves-light btn-flat white-text" onclick="showtab1();">Sign In</a>
                                </div>
                  </div>

                </div>
                </div>
			</div></div>

	<div class="bg-blur dark">
		<div class="overlay"></div><!--.overlay-->
	</div><!--.bg-blur-->

<script type="text/javascript"> 
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 50 // Creates a dropdown of 15 years to control year
  });
 function isNumber(evt)  
{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
             return false;
        return true;
}
function register()
{
	var result="";
	var mob= document.getElementById("mobno").value;
	var pattern_regno = /^[0-1]{1}[0-9]{1}[a-zA-Z]{3}[0-9]{4}$/;
	var pattern_email = /^\w+([\.-]?\w+)*@vit.ac.in+$/;
	var regno = document.getElementById("regno_id").value;
	var email = document.getElementById("email_id").value;
	var dob = document.getElementById("dob").value;
	if(!regno.match(pattern_regno))
	{
		toast("Invalid Registration Number!", 3000, "#e53935 red darken-1");
		return false;
	}
	
	/*if(!email.match(pattern_email))
	{
		toast("Invalid Email!", 3000, "#e53935 red darken-1");
		return false;
	}*/
	
	document.getElementById("register").disabled=true;
	var xmlhttp = new XMLHttpRequest();
  	xmlhttp.onreadystatechange=function()
  	{
    	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
			document.getElementById("register").disabled=false;
      		var result = xmlhttp.responseText;
			toast(result, 3000, "#e53935 red darken-1");
			document.write(result);
    	}
  	}
	xmlhttp.open("POST","registration/register_user.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("regno="+regno+"&email="+email+"&dob="+dob+"&mob="+mob);
	
	
}
function showtab1(){
      $("#tab1").show();
      $(".tabln").show();
      $("#tab3").hide();
     }
function hide1tab3(){
      $("#tab3").hide();
      $("#fwpd").show();
     }
function hide2tab3(){
      $("#tab3").hide();
      $("#fwpd").hide();
     }
function showtab3()
{
      $("#tab3").show();
}
 $(document).ready(function(){ 
     $(".tab3c").hide();
     $(".tab3").click(function(){
        $(".tab1").hide();
        $(".tabln").hide();
     });
   
});
</script>
                
</body>
</html>