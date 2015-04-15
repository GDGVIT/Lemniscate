<?php
session_start();
require("Database/sql_con.php");
$uname="";
$gen_id = substr($_SESSION["gen_id"],0,-10);
$stmt = $mysqli->prepare("SELECT * FROM `info_user` WHERE md5(`gen_id`)=? ");
$stmt->bind_param("i", $gen_id);	
if($stmt->execute())
{
	if($rs = $stmt->get_result())
	{
		$count = mysqli_num_rows($rs);
		while ($arr = mysqli_fetch_array($rs)) 
		{
			$uname = $arr["name"];		
		}
	}
}
?>