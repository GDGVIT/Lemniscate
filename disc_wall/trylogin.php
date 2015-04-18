<?php
session_start();
require("Database/sql_con.php");
//Login automatically if a session already exists
if(isset($_SESSION["user"])&&(!isset($_POST['submit'])))
{
	header("Location:disc_wall.php");
}
else if(isset($_POST['submit']))
{
	//echo "Im here";
	$name=$_POST['user'];
	$pass=$_POST['pass'];
	$login="SELECT * FROM `try_login` WHERE user='$name' and pass='$pass'";
	$res=mysqli_query($mysqli,$login);
	if($res)
	{
		$_SESSION['user']=$name;
		header("Location:disc_wall.php");
	}
}
else
{
	echo "Username<br/>
	<form action='".$_SERVER['PHP_SELF']."' method='POST'>
	<input type='text' name='user'></input></br>
	Password</br>
	<input type='password' name='pass'></input>
	<input type='submit' name='submit' value='sumbit'>";
}
