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
    	require 'Database/sql_con.php';
        $login_name=$_SESSION['user'];
        $table_no=$_REQUEST['table_no'];
        $init_count=$_REQUEST['init_count'];
        $total_count=$_REQUEST['total_count'];

        $new_init=$init_count+15;
        $new_end=$new_init+15;

        if($total_count>$new_end)
            $sql_display="SELECT * FROM `post_table_$table_no` ORDER BY date_time desc LIMIT $new_init, $new_end";
        else
            $sql_display="SELECT * FROM `post_table_$table_no` ORDER BY date_time desc LIMIT $new_init, $total_count";

        $res_display=mysqli_query($mysqli,$sql_display);
        if(mysqli_num_rows($res_display)>0)
        {
            while($arr=mysqli_fetch_array($res_display))//need to get the ans of the respective indiv and also the like status
            { 
                                                       //so that we wont like again..replies will be timing ordered for posts
                $name=$arr['regno'];                    // and w.r.t total no of upvotes for question tags
                $post_text=$arr['post_text'];
                $stat_qstn=$arr['status_qstn'];
                $no_likes=$arr['no_of_likes_ans'];
                $pic_address=$arr['pic_address'];
                $anoymous_status=$arr['anoymous_status'];
                $date_time=$arr['date_time'];
                $post_id=$arr['unique_id'];

                if($anoymous_status==1)
                    $name="Anoymous";
                
                echo "<h2>$name</h2>
                        <p>$post_text</p>";
                    if($pic_address!='')
                        echo "<img src='$pic_address' alt='$name's uploaded pic/>";
                echo"<p>date:$date_time</p>";
                
                if($stat_qstn==1)
                {
                    $sql_ans_req_count="SELECT no_of_likes_ans FROM `post_table_$table_no` WHERE unique_id='$post_id';";
                    $res_ans_req_count=mysqli_query($mysqli,$sql_ans_req_count);
                    if(mysqli_num_rows($res_ans_req_count)==1)
                    {
                        while($count=mysqli_fetch_array($res_ans_req_count))
                        { 
                            $count_ans_req=$count['no_of_likes_ans'];
                            echo "<div id='numb_ans_".$post_id."'>Number of people who require answer are ".$count_ans_req."</div>";
                        }
                    } 

                    $sql_ans_req_stat="SELECT * FROM `ans_req_likes_$table_no` WHERE qstn_id='$post_id' AND req_ans_reg_no='$login_name'";
                    $res_ans_req_stat=mysqli_query($mysqli,$sql_ans_req_stat);
                    if(mysqli_num_rows($res_ans_req_stat)==0)
                        echo "<div id='want_ans_".$post_id."'><button onclick='ans_req(".$table_no.",this.id)' id='$post_id' >Even I need the answer</button></div><br/>";
                    else //revert back requiring the answer 
                        echo "<div id='want_ans_".$post_id."'><button onclick='dnt_req_ans(".$table_no.",this.id)' id='$post_id' >I don't wanna know answer</button></div><br/>";


                    $sql_ans_replies="SELECT * FROM `reply_posts_$table_no` WHERE comment_id='$post_id' ORDER BY likes_upvotes desc";
                    $res_ans_replies=mysqli_query($mysqli,$sql_ans_replies);
                    $total_numb_replies=mysqli_num_rows($res_ans_replies);
                    {
                        if($res_ans_req_count)
                        {
                            $rep_count=0;
                            echo "<div id='prev_reply_".$post_id."'>";  //div for previous replies
                                
                            //** load_all_replies and if statement below and the other if after the while loop must use the same number
                                
                            while($reply_arr=mysqli_fetch_array($res_ans_replies))
                            {
                                if($rep_count==4)
                                    break;

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

                                $rep_count++;
                            }

                            //** Pagination of replies

                            if($total_numb_replies>4)
                            {
                                echo "<div id='more_replies_".$post_id."'><button onclick='load_more_replies(".$table_no.",".$total_numb_replies.",this.id)' id='$post_id' >Load More</button></div><br/>";
                            }
                            echo "</div>";
                        }
                        
                    }

                    //div for present replies
                    echo "<div id='present_reply_".$post_id."'>  
                    </div>";
                    //change it from here...else for select all should be here

                                    echo "<div id='ans_this_".$post_id."'>
                                        <textarea id='ans_".$post_id."' placeholder='Type your answer here' ></textarea> 
                                        <input type='checkbox' name='reply_anoymous' id='reply_anoymous_".$post_id."' value='1' >Post as anoymous</input><br/>       
                                        <button onclick='ans_this_qstn(".$table_no.",this.id)' id='$post_id'>Sumbit Answer</button>
                                      </div>

                                      </br></br></br>";
                                
                }



                else //posts
                {
                    $sql_ans_req_count="SELECT no_of_likes_ans FROM `post_table_$table_no` WHERE unique_id='$post_id';";
                    $res_ans_req_count=mysqli_query($mysqli,$sql_ans_req_count);
                    if(mysqli_num_rows($res_ans_req_count)==1)
                    {
                        while($count=mysqli_fetch_array($res_ans_req_count))
                        { 
                            $count_ans_req=$count['no_of_likes_ans'];//changed
                            echo "<div id='numb_like_".$post_id."'>Number of people who like are ".$count_ans_req."</div>";
                        }
                    } 

                    $sql_ans_req_stat="SELECT * FROM `ans_req_likes_$table_no` WHERE qstn_id='$post_id' AND req_ans_reg_no='$login_name'";
                    $res_ans_req_stat=mysqli_query($mysqli,$sql_ans_req_stat);
                    if(mysqli_num_rows($res_ans_req_stat)==0)//changedt
                        echo "<div id='like_ans_".$post_id."'><button onclick='like_this(".$table_no.",this.id)' id='$post_id' >I like it</button></div><br/>";
                    else //revert back requiring the answer 
                        echo "<div id='like_ans_".$post_id."'><button onclick='dnt_like_this(".$table_no.",this.id)' id='$post_id' >I don't like it anymore</button></div><br/>";



                    $sql_ans_replies="SELECT * FROM `reply_posts_$table_no` WHERE comment_id='$post_id' ORDER BY likes_upvotes desc";
                    $res_ans_replies=mysqli_query($mysqli,$sql_ans_replies);
                    $total_numb_comments=mysqli_num_rows($res_ans_replies);
                    {
                        if($res_ans_req_count)
                        {
                            //changed
                            $comments_count=0;
                            echo "<div id='prev_comments_".$post_id."'>";  //div for previous replies
                                
                            while($reply_arr=mysqli_fetch_array($res_ans_replies))
                            {
                                if($comments_count==4)
                                    break;

                                $likes=$reply_arr['likes_upvotes'];
                                $regno=$reply_arr['regno'];
                                $reply_text=$reply_arr['reply_text'];
                                $date_time=$reply_arr['date_reply'];
                                //$pic_address=$reply_arr['pic_address'];
                                $anoymous=$reply_arr['anoymous_status'];
                                $reply_id=$reply_arr['reply_id'];
                                $unique_reply=$reply_arr['unique_id'];

                                if($anoymous==1)
                                    $regno="Anoymous";

                                //changed
                                echo
                                    "Regno :".$regno."</br>". 
                                    "Answer :".$reply_text."</br>".
                                    "<div id='likes_count_".$unique_reply."'>Likes :".$likes."</div></br>".
                                    $date_time."</br>";

                                $sql_upvote_stat="SELECT * FROM `likes_upvotes_$table_no` WHERE unique_id_post='$unique_reply' AND regno_liked='$login_name'";
                                $res_upvote_stat=mysqli_query($mysqli,$sql_upvote_stat);
                                if(mysqli_num_rows($res_upvote_stat)==0)//changed
                                    echo "<div id='like_comment_".$unique_reply."'><button onclick='like_comment(".$table_no.",this.id)' id='$unique_reply' >Like the reply</button></div><br/>";
                                else //revert back requiring the answer 
                                    echo "<div id='like_comment_".$unique_reply."'><button onclick='dnt_like_comment(".$table_no.",this.id)' id='$unique_reply' >I Don't like the reply anymore</button></div><br/>";

                                    $comments_count++;
                            }

                            //** Pagination of comments

                            if($total_numb_comments>4)
                            {
                                echo "<div id='more_replies_".$post_id."'><button onclick='load_more_replies(".$table_no.",".$total_numb_comments.",this.id)' id='$post_id' >Load More</button></div><br/>";
                            }

                            echo "</div>";
                        }
                        
                    }

                    //div for present replies
                    echo "<div id='present_comments_".$post_id."'> 
                    </div>";

                                    //changed a lot
                                    echo "<div id='reply_this_".$post_id."'>
                                        <textarea id='reply_".$post_id."' placeholder='Type your answer here' ></textarea> 
                                        <input type='checkbox' name='reply_anoymous' id='give_reply_anoymous_".$post_id."' value='1' >Post as anoymous</input><br/>       
                                        <button onclick='reply_this_post(".$table_no.",this.id)' id='$post_id'>Sumbit Answer</button>
                                      </div>

                                      </br></br></br>";
                }

            }
            //end of While
            if($total_count>$new_init)
        echo "<div id='more_posts_$init_count'><button onclick='load_more_posts(".$table_no.",".$new_init.",".$total_count.")'>Load More Posts</button></div><br/>";
            
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