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
        $reply_text=$_REQUEST['reply_text'];
        $anoymous_status=$_REQUEST['anoymous'];

        $d=date('Y-m-d G:i:s');
        
        $sql_ans_req_count="SELECT * FROM `post_table` WHERE unique_id='$qstn_id';";
    	$res_ans_req_count=mysqli_query($mysqli,$sql_ans_req_count);
        if(mysqli_num_rows($res_ans_req_count)==1)
        {
            while($arr=mysqli_fetch_array($res_ans_req_count))
            {                                           
                $name=$arr['regno'];                    
                $stat_qstn=$arr['status_qstn'];
                $no_likes=$arr['no_of_likes_ans'];
                $pic_address=$arr['pic_address'];
                $date_time=$arr['date_time'];
                $post_id=$arr['unique_id'];
            }

            //See if the replies exists for the given post or else create a new row

            $sql_search_reply="SELECT * from `reply_posts` WHERE comment_id='$qstn_id' ORDER BY reply_id desc;";
            $res_search_reply=mysqli_query($mysqli,$sql_search_reply);
            if(mysqli_num_rows($res_search_reply)>0)
            {
                while($prev_reply=mysqli_fetch_array($res_search_reply))
                {
                    $reply_id=$prev_reply['reply_id'];
                    //echo $reply_id."</br>";
                    //echo "just broke up";
                    break;
                }

                $reply_id=$reply_id+1;

                $sql_insert="INSERT INTO `db`.`reply_posts` (`regno`, `comment_id`, `reply_id`, `date_reply`, `anoymous_status`, `likes_upvotes`, `reply_text`) VALUES ('$login_name', '$qstn_id', '$reply_id', '$d', '$anoymous_status', '0', '$reply_text')";
                $res_insert=mysqli_query($mysqli,$sql_insert);
                if($res_insert)
                {

                        //get the unique id of the reply_posts and use it here

                        $sql_id_upvote="SELECT * FROM `reply_posts` WHERE comment_id=$qstn_id AND reply_id=$reply_id;";
                        $res_id_upvote=mysqli_query($mysqli,$sql_id_upvote);
                        if(mysqli_num_rows($res_id_upvote)==1)
                        {
                            while($arr_id=mysqli_fetch_array($res_id_upvote))
                            {
                                $unique_reply=$arr_id['unique_id'];
                                break;
                            }

                         if($anoymous_status==1)
                            $login_name="Anoymous";
                                echo
                                    "Regno :".$login_name."</br>". 
                                    "Answer :".$reply_text."
                                    <div id='likes_count_".$unique_reply."'>Likes :0</div></br>".
                                    $d."</br>";   

                    echo "<div id='like_comment_".$unique_reply."'><button onclick='like_comment(this.id)' id='$unique_reply' >Like the reply</button></div><br/>";
                                
                                
                        }   
                }
                else
                {
                    echo "not insertrd";
                }
                         
            }
            else//keep reply status 0
            {
                //echo "no reply yet";
                //echo "<h1>$anoymous_status</h1>";
                $sql_insert="INSERT INTO `db`.`reply_posts` (`regno`, `comment_id`, `reply_id`, `reply_text`, `date_reply`, `anoymous_status`, `likes_upvotes`) VALUES ('$login_name', '$qstn_id', '0', '$reply_text', '$d', '$anoymous_status', '0');";
                $res_insert=mysqli_query($mysqli,$sql_insert);
                if($res_insert)
                {
                        $sql_id_upvote="SELECT * FROM `reply_posts` WHERE comment_id=$qstn_id AND reply_id=0;";
                        $res_id_upvote=mysqli_query($mysqli,$sql_id_upvote);
                        if(mysqli_num_rows($res_id_upvote)==1)
                        {
                            while($arr_id=mysqli_fetch_array($res_id_upvote))
                            {
                                $unique_reply=$arr_id['unique_id'];
                                break;
                            }
                                if($anoymous_status==1)
                                    $login_name="Anoymous";
                                echo
                                    "Regno :".$login_name."</br>". 
                                    "Answer :".$reply_text."
                                    <div id='likes_count_".$unique_reply."'>Likes :0</div></br>".
                                    $d."</br>";

                                echo "<div id='like_comment_".$unique_reply."'><button onclick='like_comment(this.id)' id='$unique_reply' >Like the reply</button></div><br/>";
                                
                        }
        
                            
                }
                else
                {
                    echo "reply not accepted";
                }
            }
    
        }

    }
    //else logout
?>