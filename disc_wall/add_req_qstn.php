<?php
//disc-wall
    session_start();
    if(!isset($_SESSION['user']))
    {
        $_SESSION['user']='13BCE0267';
    }
    if(isset($_REQUEST['id']))
    {
    	require 'Database/sql_con.php';
        $login_name=$_SESSION['user'];

    	$qstn_id=$_REQUEST['id'];
    	$sql_ans_req="INSERT INTO `ans_req_likes`(req_ans_reg_no,qstn_id) VALUES('$login_name','$qstn_id');";
    	$res_ans_req=mysqli_query($mysqli,$sql_ans_req);
    	if($res_ans_req==true)
    	{
    		$sql_inc_ans_req="UPDATE `post_table` SET no_of_likes_ans=no_of_likes_ans+1 WHERE unique_id='$qstn_id';";
    		$res_inc_ans_req=mysqli_query($mysqli,$sql_inc_ans_req);
    		if($res_inc_ans_req==true)
    		{
    			echo "<div id='want_ans_".$qstn_id."'><button onclick='dnt_req_ans(this.id)' id='$qstn_id' >I don't wanna know answer</button></div>";
    				
    		}
    		else//revert back already liked status
	    	{
	    		echo "Sorry!,try again later";
	    	}
	    		
    	}
    	else
    	{
    		echo "Sorry!,try again later";
    	}
    }
    else
    {
    	session_unset();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		session_destroy();
		header("Location:login.php");
		exit();
	}
?>