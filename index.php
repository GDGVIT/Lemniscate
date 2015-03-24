<?php
require("database/sql_con.php");
if(isset($_POST["login"]))
{
	$uname=$_POST["uname_id"];
	$pword=$_POST["pword_id"];
	$stmt = $mysqli->prepare("SELECT * FROM `login` WHERE `uid`=?  AND `password`=?");
	$stmt->bind_param("ss", $uname, $pword);	
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
		echo "Query not executed";
	
}
else if(isset($_POST["register"]))
{
	
}
?>
<!DOCTYPE HTML>
<HTML>
<HEAD><TITLE>Leminiscate</TITLE></HEAD>
<BODY>

<!-- Login Form-->
<FORM action= "<?php echo $_SERVER["PHP_SELF"];?>"  method="POST">
Username:<INPUT TYPE="text" id="uname_id" name="uname_id" placeholder="Username" autocomplete="off">
Password:<INPUT TYPE="password" id="pword_id" name="pword_id" placeholder="Password" autocomplete="off"><br>
<INPUT TYPE="checkbox" id="save_login" name="save_login" checked>Keep me logged in<br>
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