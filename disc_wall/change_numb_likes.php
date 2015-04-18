<?php
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
        
        $sql_ans_req_count="SELECT no_of_likes_ans FROM `post_table` WHERE unique_id='$qstn_id';";
    	$res_ans_req_count=mysqli_query($mysqli,$sql_ans_req_count);
    	if(mysqli_num_rows($res_ans_req_count)==1)
    	{
    		while($count=mysqli_fetch_array($res_ans_req_count))
	    	{ 
	    		$count_ans_req=$count['no_of_likes_ans'];
	    		echo "<div id='likes_count_".$qstn_id."'>Number of people who like are ".$count_ans_req."</div>";
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