<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        $_SESSION['user']='13BCE0267';
    }
    if(isset($_REQUEST['table_no']))
    {
        $table_no=$_REQUEST['table_no'];
    }
    else
    {
            $table_no=13;
    }
    if(isset($_REQUEST['id']))
    {
    	require 'Database/sql_con.php';
        $login_name=$_SESSION['user'];

        $qstn_id=$_REQUEST['id'];
        $total_numb_replies=$_REQUEST['tot_replies'];

           echo "<button onclick='load_more_replies(".$table_no.",".$total_numb_replies.",this.id)' id='$qstn_id' >Load More</button></div><br/>";
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