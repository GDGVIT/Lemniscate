<?php
	require("../Database/sql_con.php");
	
	$flag =0; //To know if the dob and regno are valid
	$regno = $_POST["regno"];
	$email = $_POST["email"];
	$dob = $_POST["dob"];
	$mob = $_POST["mob"];
	
	$date = date_create_from_format('j M, Y', $dob);
	$dob =date_format($date, 'dmY');
	
	$url  ="https://vit-login.herokuapp.com/class-details?reg_no=".$regno."&dob=".$dob."&mob_num=".$mob;
	
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
	   echo "01"; // CURL Failure
	   return;
	}
	
	$json = json_decode($result,true);
	if (is_null($json)) 
	{
	    //"Json decoding failed with error: ". json_last_error_msg();
		echo "02"; // JSON Decoding Error
		return;
	}

	$class_details=json_decode($result,true);
	
	//Close connection
	curl_close($ch);
	
	if(!is_array($class_details))
	{
		echo "03"; //Null Array Error
		return;
	}
	else
	{
		print_r($class_details["status"]);
		
		//Check if success or failure
		if($class_details["status"]=="Failure")
		{
			echo "04"; //Failure - Invalid Credentials
			return;
		}
		
		$i=0;
		$subjects_present=$class_details["class_details"];
		$past=$class_details["past_grades"];
		$each_subject=array();
		$past_subject=array();
		
		//Alumni Class Groups
		foreach($past as $code=>$subject_name)
		{	
			$stmt = $mysqli->prepare("SELECT * FROM `alumni_classes` WHERE `code`= ?");
			$stmt->bind_param("s",$code);	
			$stmt->execute();
			$result = $stmt->get_result();
			
			$alumni_class = mysqli_num_rows($result);
	
			//If the course is not in the alumni table
			if($alumni_class==0)
			{
				$stmt1 = $mysqli->prepare("INSERT INTO `alumni_classes` (code, title,members_past) VALUES (?, ?,?)");
				$stmt1->bind_param("sss",$code, $subject_name,$regno);	
				if($stmt1->execute())
				{			
					$stmt2 = $mysqli->prepare("SELECT id FROM `alumni_classes` WHERE `code`= ?");
					$stmt2->bind_param("s",$code);	
					$stmt2->execute();
					$result = $stmt2->get_result();
					$arr = mysqli_fetch_array($result);
					if($arr)
					{
						$gen_id_alumni = $arr[0];
						$stmt3 = $mysqli->prepare("UPDATE `courses_now` SET `alumni_id` = ? WHERE `code`= ?");
						$stmt3->bind_param("is",$gen_id_alumni,$code);	
						$stmt3->execute();
					}
					else 	//else condition if not able to set the alumni id to the current classes
					{
						$stmt4 = $mysqli->prepare("DELETE FROM `alumni_classes` WHERE `code`= ? AND `title`=?");
						$stmt4->bind_param("ss",$code, $s);	
						$stmt4->execute();
						$flag = 1;
					}
				}
				else //Subject NOT inserted into alumni_classes table
				{
					$flag = 1;
				}
			}
			//If the course is already there in the alumni table
			else if($alumni_class==1)
			{
				$members = array();
				$stmt5 = $mysqli->prepare("SELECT members_past FROM `alumni_classes` WHERE `code`= ?");
				$stmt5->bind_param("s",$code);	
				$stmt5->execute();
				$result = $stmt5->get_result();
				$arr1 = mysqli_fetch_array($result);
				
				$members = explode(",",$arr1[0]);
				$members[count($members)] = $regno;
				$members_str = implode("," ,$members);
				
				$stmt6 = $mysqli->prepare("UPDATE `alumni_classes`SET `members_past` = ? WHERE `code` = ?");
				$stmt6->bind_param("ss",$members_str,$code);	
				if(!$stmt6->execute())
				{
					$flag=1;
				}
			}
		}
		//reinitialization
		$code="";
		foreach($subjects_present as $code =>$s)
		{	
			$each_subject = $s;
			$stmt = $mysqli->prepare("SELECT * FROM `courses_now` WHERE `class_num`= ? AND `slot`=?  AND `code` = ? AND  `venue`=? ");
			$stmt->bind_param("ssss",$code, $each_subject[0], $each_subject[2], $each_subject[3]);	
			$stmt->execute();
			$result = $stmt->get_result();
			$class_now = mysqli_num_rows($result);
			
			//If the course is not in the CURRENT CLASS table
			if($class_now==0)
			{
				//Retreive Alumni ID
				$stmt = $mysqli->prepare("SELECT id FROM `alumni_classes` WHERE `code`= ?");
				$stmt->bind_param("s",$each_subject[2]);	
				$stmt->execute();
				$result = $stmt->get_result();
				if(mysqli_num_rows($result)>0)
					$arr = mysqli_fetch_array($result);
				else
					$arr[0]=0;
				
				$stmt1 = $mysqli->prepare("INSERT INTO `courses_now` (`class_num`, `slot`, `title`, `code`, `venue`, `faculty`,`alumni_id`,`members_present`) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
				$stmt1->bind_param("isssssis",$code, $each_subject[0], $each_subject[1],$each_subject[2],$each_subject[3],$each_subject[4],$arr[0],$regno);	
				if($stmt1->execute())
				{
					$stmt2 = $mysqli->prepare("UPDATE `alumni_classes`SET `members_present` = ? WHERE `code` = ?");
					$stmt2->bind_param("ss",$regno,$code);	
					if(!$stmt2->execute())
					{
						$flag=1;
					}
				}
				else
				{
						$flag=1;
				}
			}
			//If the course is already there in the courses_now table
			else if($class_now==1)
			{
					$stmt = $mysqli->prepare("SELECT members_present FROM `courses_now` WHERE `class_num`= ? AND `slot`=?  AND `code` = ? AND  `venue`=? ");
					$stmt->bind_param("ssss",$code, $each_subject[0], $each_subject[2], $each_subject[3]);	
					$stmt->execute();
			
					$members = array();
					$stmt1 = $mysqli->prepare("SELECT members_present FROM `alumni_classes` WHERE `code`= ?");
					$stmt1->bind_param("s",$code);	
					$stmt1->execute();
					$result = $stmt1->get_result();
					$arr1 = mysqli_fetch_array($result);
				
					$members = explode(",",$arr1[0]);
					$members[count($members)] = $regno;
					$members_str = implode("," ,$members);
					
					$stmt2 = $mysqli->prepare("UPDATE `alumni_classes`SET `members_present` = ? WHERE `code` = ?");
					$stmt2->bind_param("ss",$members_str,$code);	
					if(!$stmt2->execute())
					{
						$flag=1;
					}
			}
		}
	}
	echo "here1";
	if($flag!=1)
	{
				echo "here";
				require("../generate_hash.php");
				$ResultStr = generateHash();
				$activated=0;
				$res=substr(md5($ResultStr),0,20);
				$dob = date_format($date, 'Y-m-d');
				$stmt = $mysqli->prepare("INSERT INTO `reg_verification` (`regno`, `dob`, `email`, `gen_password`, `activated`) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("ssssi", $regno, $dob,$email,$res,$activated);	
				if($stmt->execute())
				{
					date_default_timezone_set('Asia/Calcutta');
					require ('../mail/PHPMailerAutoload.php');
					//Create a new PHPMailer instance
					$mail = new PHPMailer();
					/*
					if($mail->smtpConnect())
					{
					*/
							$to= $email; 
							$subject= "Leminiscate | Verification" ;
							
							$link="localhost/lemniscate/verification/verify_registration.php?p=$ResultStr&e=$email&d=$dob";
							require("../etemplate/reg_msg.php");
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

							$mail->Encoding = "base64";
							$mail->Timeout = 200;
							$mail->ContentType = "text/html";
							
							//Replace the plain text body with one created manually
							$mail->Body = $message;
							
							$mail->AltBody = "Use an HTML compatible email client";

							//send the message, check for errors
							if (!$mail->send())
							{
								echo "04: Mailer Error: " . $mail->ErrorInfo;
								
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
					echo "06: Error in inserting the data into reg_verification";
					//echo "Error in inserting the data into reg_verification";	
				}
	}
?>