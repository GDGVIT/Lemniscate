<?php

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
			while ($arr = mysqli_fetch_array($rs)) 
			{
				$uname_db = $arr["uid"];
				$pword_db = $arr["password"];	
				$gen_id = $arr["gen_id"];		
			}
			if((strcmp($uname,$uname_db)==0)&&(strcmp($pword,$pword_db)==0))
			{
				if (isset($_POST["save_login"]))
				{
						//cookie to be created
				}
				header("location:home.php");
			}
			else
			{
				echo "Enter a valid username and password";
			}
		}
		else
			echo"Result set not fetched mysqli_error()";
	}
	else
		echo "Query not executed mysqli_error()";
}
else if(isset($_POST["register"]))
{
$url  ='https://vitacademics-rel.herokuapp.com/api/v2/vellore/login';
$fields = array(
						"regno" => "12mse0363",
						"dob" => "01101994",
				);
$fields_string="";
//url-ify the data for the POST
foreach($fields as $key=>$value) 
{ 
	$fields_string .= $key.'='.$value.'&';
}
rtrim($fields_string, '&');
$fields_string="regno=12mse0363&dob=01101994";
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
//curl_setopt($ch,CURLOPT_POSTFIELDS, "regno=12mse0363&dob=01101994");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('json'=>json_encode("{regno: 12mse0363},{dob:01101994}")));
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8","Accept:application/json"));

//execute post
$result = curl_exec($ch);
echo $result;
if ($result == FALSE) 
{
   die("Curl failed with error: " . curl_error($ch));
}
$json = json_decode($result,true);
if (is_null($json)) 
{
   print_r("Json decoding failed with error: ". json_last_error_msg());
}

	$a=json_decode($result,true);
	//close connection
	curl_close($ch);

	$flag=0;
	$regno=$_POST["regno_id"];
	$email=$_POST["email_id"];
	$dob = $_POST["dob"];
	$pattern_regno = "/^[0-1]{1}[0-9]{1}[a-zA-Z]{3}[0-9]{4}$/";
	$pattern_email = " /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
	
	//Regno Check
	if(!preg_match($pattern_regno,$regno))
	{
		echo"Invalid Regno";
		$flag=1;
	}
	
	//Email Check
	if(preg_match($pattern_email,$email))
	{
		//VIT Email Format check
		if(strrpos($email,"@vit.ac.in")>1)
		{
			if($flag==0)
			{
				$RandomStr = base64_encode(microtime());
				$ResultStr = substr($RandomStr,0,20);
				$ResultStr = strtolower($ResultStr);
				$activated=0;
				$stmt = $mysqli->prepare("INSERT INTO `reg_verification` (`regno`, `dob`, `email`, `gen_password`, `activated`) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("ssssi", $regno, $dob,$email,$ResultStr,$activated);	
				if($stmt->execute())
				{
					date_default_timezone_set('Asia/Calcutta');
					require 'mail/PHPMailerAutoload.php';
					//Create a new PHPMailer instance
					$mail = new PHPMailer();
					/*if($mail->smtpConnect())
					{*/
							$to= $email; 
							$subject= "Leminiscate | Verification" ;
							$message="Pls check this link localhost/lemniscate/verify_registration.php?p=$ResultStr&e=$email&d=$dob";
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
								echo "Message sent! Check your mail for details";
							}
				/*	}
					else
						echo "Mailer connection problem";*/
				}
				else
				{
					echo "Error in inserting the data into reg_verification";	
				}
			}
		}
		else
		{	
			echo "Enter VIT Email ID";
		}			
	}
	else
	{
		echo "Invalid Email ID";
	}
	
	
}
?>
<!Doctype html>
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
                      <li class="tab col s3"><a href="#tab1" class="active" onclick="hide1tab3();">Login</a></li>
                      <li class="tab col s3"><a href="#tab2" onclick="hide2tab3();">New User</a></li>
                    </ul>
                  </div>
                  <div id="tab1" class="col s12 tab1">
                                 <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="uname_id" type="text" class="validate white-text">
                                      <label for="uname_id">Username</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input id="pword_id" type="password" class="validate white-text">
                                      <label for="pword_id">Password</label>
                                    </div>
                                   <div class="remcheck col s12">
                                   	<input type="checkbox" id="save_login" />
                                      <label for="save_login">Remember Me</label>
                                   </div>
                                   <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	<button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Submit
                                        <i class="mdi-content-send right"></i>
                                      </button>
                                   </div>
                                 </div>
                                </form>
                  </div>

                  <div id="tab2" class="col s12 tab2">
                                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_id" type="text" class="validate white-text">
                                      <label for="regno_id">Registration Number</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input id="pwd" type="password" class="validate white-text">
                                      <label for="pwd">Password</label>
                                    </div>
                                   <div class="input-field col s12">
                                      <input id="email_id" type="email" class="validate white-text">
                                      <label for="email_id">Email ID</label>
                                    </div>
                                    <div class="input-field col s12">
                                    <label for="birthdate">Birthdate</label>
                                    <input id="birthdate" type="text" class="datepicker white-text">
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	   <button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Register
                                        <i class="mdi-social-person-add right"></i>
                                      </button>
                                   </div></div>
                                </form>
                  </div>
                  <div class="col s12" id="fwpd" style="text-align:center;">
                  <a class="waves-effect waves-light btn-flat tab3 white-text" onclick="showtab3();">Forgot Password</a>
                  </div>
                  <div id="tab3" class="col s12 tab3c">
                                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_id" type="email" class="validate white-text">
                                      <label for="regno_id">Email ID</label>
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                       <button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Get Password
                                        <i class="mdi-action-get-app right"></i>
                                      </button>
                                   </div></div>
                                </form>
                                <div class="col s12" style="text-align:center;">
                                <a class="waves-effect waves-light btn-flat white-text" onclick="showtab1();">Login</a>
                                </div>
                  </div>

                </div>
                </div>
			</div></div>

	<div class="bg-blur dark">
		<div class="overlay"></div><!--.overlay-->
	</div><!--.bg-blur-->

<script type="text/javascript"> $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 50 // Creates a dropdown of 15 years to control year
  });</script>
<script type="text/javascript">
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
function showtab3(){
      $("#tab3").show();
     }
  $(document).ready(function(){ 
     $(".tab3c").hide();
     $(".tab3").click(function(){
        $(".tab1").hide("slow");
        $(".tabln").hide();

     });
   
});
</script>
                
</body>
</html>
