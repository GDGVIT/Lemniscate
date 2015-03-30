<?php
	
	$flag =0; //To know if the dob and regno are valid
	$regno=$_POST["regno_id"];
	$email=$_POST["email_id"];
	$dob = $_POST["dob"];
	
	$url  ="https://vit-login.herokuapp.com/login?reg_no=".$regno."&dob=".$dob;
	//Open connection
	$ch = curl_init();
	//Set the url
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
	//Execute CURL
	$result = curl_exec($ch);
	if ($result == FALSE) 
	{
	   echo "Curl failed with error: " . curl_error($ch);
	   $flag=1;
	}
	$json = json_decode($result,true);
	if (is_null($json)) 
	{
	    echo "Json decoding failed with error: ". json_last_error_msg();
		$flag=1;
	}
	$class_details=json_decode($result,true);
	//Close connection
	curl_close($ch);
	
	if(!is_array($class_details))
	{
		$flag=1;
	}
	else
	{
		$q1 = $mysqli->prepare("INSERT INTO `courses_now` (`regno`, `dob`, `email`, `gen_password`, `activated`) VALUES (?, ?, ?, ?, ?)");
		$q1->bind_param("ssssi", $regno, $dob,$email,$ResultStr,$activated);	
		if($q1->execute())
		{
				$q2= $mysqli->prepare("INSERT INTO `alumini_classes` (`regno`, `dob`, `email`, `gen_password`, `activated`) VALUES (?, ?, ?, ?, ?)");
				$q2->bind_param("ssssi", $regno, $dob,$email,$ResultStr,$activated);	
				if($q2->execute())
				{
					
				}
		}		
	}
	if($flag==1)
	{
		echo "Regno and  DOB do not match!";
	}
	else
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
					/*
					if($mail->smtpConnect())
					{
					*/
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
				/*
					}
					else
						echo "Mailer connection problem";
				*/
				}
				else
				{
					echo "Error in inserting the data into reg_verification";	
				}
	}
	
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
		
?>