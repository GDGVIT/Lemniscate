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
        $sql_ans_req="DELETE FROM `ans_req_likes_$table_no` WHERE req_ans_reg_no='$login_name' AND qstn_id='$qstn_id';";
        $res_ans_req=mysqli_query($mysqli,$sql_ans_req);
        if($res_ans_req==true)
        {
            $sql_inc_ans_req="UPDATE `post_table_$table_no` SET no_of_likes_ans=no_of_likes_ans-1 WHERE unique_id='$qstn_id';";
            $res_inc_ans_req=mysqli_query($mysqli,$sql_inc_ans_req);
            if($res_inc_ans_req==true)
            {
                echo "<div id='like_ans_".$qstn_id."'><button onclick='like_this(".$table_no.",this.id)' id='$qstn_id' >I like it</button></div>";       
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




