<?php
	require("../Database/sql_con.php");
	if(isset($_POST["pass_reset"]))
	{
		$p1 = $_POST["pword_id"];
		$p1 = $_POST["pword_id_2"];
		if(strcmp($p1,$p2)==0)
		{
				$stmt = $mysqli->prepare("UPDATE `login` SET `password`= ? WHERE `gen_id`= ?");
				$stmt->bind_param("si",$p1,$gen_id);
				if($stmt->execute())
				{
					$stmt1 = $mysqli->prepare("UPDATE `forgot_password` SET `activated` = '1' WHERE `id` = ? AND `gen_id` = ?");
					$stmt1->bind_param("ii",$forgot_password_id,$gen_id);
					if($stmt1->execute())
					{
						
					}
				}
		}
		else
			echo '<script>toast("Password has to be same", 3000, "#e53935 red darken-1");</script>';
	}
	else if(isset($_POST["p"])&&isset($_POST["e"])&&isset($_POST["d"]))
	{
		$ResultStr = $_POST["p"];
		$email = $_POST["e"];
		$date = $_POST["d"];
		
		$stmt = $mysqli->prepare("SELECT `id`,`gen_id`  FROM `forgot_password`   WHERE `hash`= ? AND `date_apply` = ? AND `email` = ? AND`activated` = ? ");
		$stmt->bind_param("sssi", $ResultStr,$date,$email,0);	
		$stmt->execute();
		
		$result = $stmt->get_result();
		$arr = mysqli_fetch_array($result);
		$count = mysqli_num_rows($result);
		
		$forgot_password_id = $arr[0] ;
		$gen_id = $arr[1];
		
		if($count==1)
		{
			echo"<form action='<?php echo $_SERVER['PHP_SELF'];?>'  method='POST'>
					<input id='pword_id' name='pword_id' type='password' class='validate white-text' autocomplete='off'>
					<label for='pword_id'>Password</label><br>
					<input id='pword_id_2' name='pword_id_2' type='password' class='validate white-text' autocomplete='off'>
					<label for='pword_id_2'>Password</label>
					<button  name='pass_reset' id='pass_reset' type='submit'>Proceed</button></form>";
		}
		else
			echo "Your Verification Link has expired";
	}
	else
		echo "Error - Access Restricted";
?>