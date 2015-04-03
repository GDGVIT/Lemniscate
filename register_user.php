<?php
	require("Database/sql_con.php");
	
	$flag =0; //To know if the dob and regno are valid
	$regno=$_POST["regno"];
	$email=$_POST["email"];
	$dob = $_POST["dob"];
	
	$date = date_create_from_format('j M, Y', $dob);
	$dob =date_format($date, 'dmY');
	
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
	   //"Curl failed with error: " . curl_error($ch);
	   echo "01";
	   $flag=1;
	}
	$json = json_decode($result,true);
	if (is_null($json)) 
	{
	    //"Json decoding failed with error: ". json_last_error_msg();
		echo "02";
		$flag=1;
	}
	$class_details=json_decode($result,true);
	
	//Close connection
	curl_close($ch);
	if(!is_array($class_details))
	{
		echo "03";
		$flag=1;
	}
	else
	{
		$i=0;
		$subjects=array();
		$past=array();
		$each_subject=array();
		$past_subject=array();
		
		//Taking  class details and past grades
		foreach($class_details as $k)
		{
			if ($i==0)
				$subjects=$k;
			if($i==1)
			{
				$past=$k;
				break;
			}
			$i++;
		}
		foreach($past as $code=>$s)
		{	
			$past_subject = $s;
			$stmt = $mysqli->prepare("INSERT INTO `alumni_classes` (`code`, `title`) VALUES (?, ?)");
			$stmt->bind_param("ss",$code, $past_subject);	
			$stmt->execute();	
		}
		foreach($subjects as $code =>$s)
		{	
			$each_subject = $s;
			$stmt = $mysqli->prepare("INSERT INTO `courses_now` (`class_num`, `slot`, `title`, `code`, `venue`, `faculty`) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssss",$code, $each_subject[0], $each_subject[1],$each_subject[2],$each_subject[3],$each_subject[4]);	
			$stmt->execute();	
		}
	}
	if($flag!=1)
	{
				$RandomStr = base64_encode(microtime());
				$ResultStr = substr($RandomStr,0,20);
				$ResultStr = strtolower($ResultStr);
				$activated=0;
				$dob = date_format($date, 'Y-m-d');
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
								echo "04";
							}
							else 
							{
								//echo "Message sent! Check your mail for details";
								echo "05";
							}
				/*
					}
					else
						echo "Mailer connection problem";
				*/
				}
				else
				{
					echo "06";
					//echo "Error in inserting the data into reg_verification";	
				}
	}
?>