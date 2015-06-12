<?php
	require("../Database/sql_con.php");
	
	$hash = substr(md5($_GET["p"]),0,20);
	$email = $_GET["e"];
	$dob = $_GET["d"];
	$stmt = $mysqli->prepare("SELECT * FROM `reg_verification` WHERE `dob`= ? AND `email` = ? AND `gen_password`= ?");
	$stmt->bind_param("sss",$dob,$email,$hash);	
	$stmt->execute();
	$result = $stmt->get_result();
	$count = mysqli_num_rows($result);
	$arr = mysqli_fetch_array($result);
	if($count==1)
	{
			$stmt1 = $mysqli->prepare("UPDATE `reg_verification` SET `activated` = '1' WHERE `id` = ?");
			$stmt1->bind_param("i",$arr[0]);
			$stmt1->execute();
			echo "valid";
	}
	else
		echo "Your Verification Link is Invalid";
?>