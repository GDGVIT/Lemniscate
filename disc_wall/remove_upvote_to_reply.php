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
        $sql_ans_req="DELETE FROM `likes_upvotes` WHERE regno_liked='$login_name' AND unique_id_post='$qstn_id';";
        $res_ans_req=mysqli_query($mysqli,$sql_ans_req);
        if($res_ans_req==true)
        {
            $sql_inc_ans_req="UPDATE `reply_posts` SET likes_upvotes=likes_upvotes-1 WHERE unique_id=$qstn_id;";
            $res_inc_ans_req=mysqli_query($mysqli,$sql_inc_ans_req);
            if($res_inc_ans_req==true)
            {
                echo "<div id='upvote_ans_".$qstn_id."'><button onclick='upvote_ans(this.id)' id='$qstn_id' >Upvote</button></div>";    
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




