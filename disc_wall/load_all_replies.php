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

        $post_id=$_REQUEST['id'];
        $total_replies_count=$_REQUEST['tot_replies'];
        
        $sql_ans_replies="SELECT * FROM `reply_posts_$table_no` WHERE comment_id='$post_id' ORDER BY likes_upvotes desc LIMIT 4,$total_replies_count";
        $res_ans_req_count=mysqli_query($mysqli,$sql_ans_replies);
    	if($res_ans_req_count)
    	{
    		while($reply_arr=mysqli_fetch_array($res_ans_req_count))
            {
                                $upvotes=$reply_arr['likes_upvotes'];
                                $regno=$reply_arr['regno'];
                                $reply_text=$reply_arr['reply_text'];
                                $date_time=$reply_arr['date_reply'];
                                //$pic_address=$reply_arr['pic_address'];
                                $anoymous=$reply_arr['anoymous_status'];
                                $reply_id=$reply_arr['reply_id'];
                                $unique_reply=$reply_arr['unique_id'];

                                if($anoymous==1)
                                    $regno="Anoymous";

                                echo
                                    "Regno :".$regno."</br>". 
                                    "Answer :".$reply_text."</br>".
                                    "<div id='upvotes_count_".$unique_reply."'>Upvotes :".$upvotes."</div></br>".
                                    $date_time."</br>";

                                $sql_upvote_stat="SELECT * FROM `likes_upvotes_$table_no` WHERE unique_id_post='$unique_reply' AND regno_liked='$login_name'";
                                $res_upvote_stat=mysqli_query($mysqli,$sql_upvote_stat);
                                if(mysqli_num_rows($res_upvote_stat)==0)
                                    echo "<div id='upvote_ans_".$unique_reply."'><button onclick='upvote_ans(".$table_no.",this.id)' id='$unique_reply' >Upvote</button></div><br/>";
                                else //revert back requiring the answer 
                                    echo "<div id='upvote_ans_".$unique_reply."'><button onclick='dnt_upvote_ans(".$table_no.",this.id)' id='$unique_reply' >Don't wanna upvote</button></div><br/>"; 
                }
                echo "<button onclick='hide_more_replies(".$table_no.",".$total_replies_count.",this.id)' id='$post_id' >Hide Replies</button><br/>";
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