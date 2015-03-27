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
$fields_string='regno=12mse0363&dob=01101994';
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
//execute post
$result = curl_exec($ch);
if ($result == FALSE) 
{
   die("Curl failed with error: " . curl_error($ch));
}
$json = json_decode($result);
if (is_null($json)) 
{
   die("Json decoding failed with error: ". json_last_error_msg());
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
<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>Leminiscate</TITLE>
<script type="text/javascript" src="js/ajax.js"></SCRIPT>
</HEAD>
<BODY>

<!-- Login Form-->
<FORM action= "<?php echo $_SERVER["PHP_SELF"];?>"  method="POST">
Username:<INPUT TYPE="text" id="uname_id" name="uname_id" placeholder="Username" autocomplete="off">
Password:<INPUT TYPE="password" id="pword_id" name="pword_id" placeholder="Password" autocomplete="off"><br>
<INPUT TYPE="checkbox" id="save_login" name="save_login" checked value="save_login">Keep me logged in<br>
<INPUT TYPE="submit" id="login" name="login" value="Login"><br>
</FORM>

<!-- Forget Password -->
<INPUT TYPE="button" id="forgot_pword" name="forgot_pword" value="Forgot Password?"><br>

New User:
<br>

<!-- Registration Form -->
<FORM action= "<?php echo $_SERVER["PHP_SELF"];?>"  method="POST">
Registration Number:<INPUT TYPE="text" id="regno_id" name="regno_id" placeholder="12MSE0363" autocomplete="off"><br>
Date of Birth:<INPUT type = "date" value ="1994-10-01" id = 'dob' name='dob'><br>
Email : <INPUT TYPE="text" id="email_id" name="email_id" placeholder="xyz@vit.ac.in" autocomplete="off"><br>
<INPUT TYPE="submit" id="register" name="register" value="Register">
</FORM>
</BODY>
</HTML>
