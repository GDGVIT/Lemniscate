<?php
//disc-wall
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
            $table_no=11;
    }
    echo "<a href='logout.php'>Click here to logout</a>";
    if(true)//check the session variable
    {
        require 'Database/sql_con.php';

        $login_name=$_SESSION['user'];

        echo "<p>Upload a Picture</p>
    	<input type='file' name='File_up' id='File_up' accept='image/x-png, image/gif, image/jpeg' />";

      	echo"<p>Post in the group</p>
    	<textarea id='post_user' name='post_user' rows='6' cols='50' autocomplete='off' placeholder='Enter your post here'></textarea></br></br>
    	</br></br>
    	
    	<button onclick='add_post(".$table_no.",1)' name='add_question'>Add as Question</button><br/><br/>
    	<button onclick='add_post(".$table_no.",0)' name='add_post'>Add as Post</button><br/>";

    	echo "<input type='radio' name='anoymous' id='not_anoymous' value='0' checked='checked'>Post with Name</input>";
    	echo "<input type='radio' name='anoymous' id='anoymous' value='1'>Post as Anoymous</input>
        <hr><h4>POSTS</h4><hr>";
        
        echo "<div id='new_post' name='new_post'></div>";

    	echo "<div id='posts_display'>";

        //**  Pagination for posts  **//
    
        $sql_display="SELECT * FROM `post_table_$table_no` ORDER BY date_time desc LIMIT 0, 15";
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

            }//end of while loop

            //**Pagination for the posts
            $sql_total_display="SELECT * FROM `post_table_$table_no`";
            $res_total_display=mysqli_query($mysqli,$sql_total_display);
            $total_count=mysqli_num_rows($res_total_display);
            if($total_count>15)
            {
                echo "<div id='more_posts_0'><button onclick='load_more_posts(".$table_no.",0,".$total_count.")'>Load More Posts</button></div><br/>";
            }                   

        }//end of IF
        else//no new news feed 
        {
                echo "Sorry! Nothing available!";
        }

        echo"</div>";
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

<script type="text/javascript">
function add_post(t_no,id)
{
    alert(t_no);
	var post_user=document.getElementById('post_user').value;
	var not_anoymous=document.getElementById('not_anoymous');
	var anoymous=document.getElementById('anoymous');
	var value_anoymous=0;
	
	if(not_anoymous.checked)
	{	
		value_anoymous=0;
	}
	else
	{
		value_anoymous=1;
	}

	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
  	{
    	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
      		document.getElementById("new_post").innerHTML=xmlhttp.responseText;
            var post_new = document.getElementById("new_post").innerHTML;
            var post_old = document.getElementById('posts_display');
            post_old.innerHTML = post_new + post_old.innerHTML;

            //alert("IM here");
            
            document.getElementById('new_post').innerHTML='';
            document.getElementById('post_user').value='';
    	}
  	}
 	xmlhttp.open("GET","add_post.php?post="+post_user+"&status_post="+id+"&anoymous="+value_anoymous+"&table_no="+t_no,true);
 	xmlhttp.send();
}

function ans_req(t_no,id)    //answer required for a question
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("want_ans_"+id).innerHTML=xmlhttp.responseText;
            change_numb(t_no,id);
        }
    }
    xmlhttp.open("GET","add_req_qstn.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}

function load_more_replies(t_no,total_rep_count,post_id)
{
    alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("more_replies_"+post_id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","load_all_replies.php?id="+post_id+"&table_no="+t_no+"&tot_replies="+total_rep_count,true);
    xmlhttp.send();
}

function load_more_posts(t_no,init_count_posts,total_count)
{
    alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("more_posts_"+init_count_posts).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","load_other_posts.php?table_no="+t_no+"&init_count="+init_count_posts+"&total_count="+total_count,true);
    xmlhttp.send();
}

function hide_more_replies(t_no,total_rep_count,post_id)
{
    alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("more_replies_"+post_id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","hide_more_replies.php?id="+post_id+"&table_no="+t_no+"&tot_replies="+total_rep_count,true);
    xmlhttp.send();
}

function like_this(t_no,id)      //like the given post
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_ans_"+id).innerHTML=xmlhttp.responseText;
            like_change_numb(t_no,id);
        }
    }
    xmlhttp.open("GET","add_like_post.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}

function change_numb(t_no,id)  //change the total number of number of ans
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("numb_ans_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_numb.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}



function dnt_req_ans(t_no,id)   //don't require an answer for a question
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("want_ans_"+id).innerHTML=xmlhttp.responseText;
            change_numb(t_no,id);
        }
    }
    xmlhttp.open("GET","remove_req_qstn.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}

function dnt_like_this(t_no,id)      //unlike the post
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_ans_"+id).innerHTML=xmlhttp.responseText;
            like_change_numb(t_no,id);
        }
    }
    xmlhttp.open("GET","remove_like_post.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();

}

function like_change_numb(t_no,id)   //changes the post's like number 
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("numb_like_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_numb_likes.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();    
}

function ans_this_qstn(t_no,id)
{
        alert(t_no);
    var reply_text=document.getElementById("ans_"+id).value;   
    var anoymous=document.getElementById("reply_anoymous_"+id);

    if(anoymous.checked)
    {
        anoymous=1;
    }

    else
        anoymous=0;

    
    if(reply_text=='')
    {
        alert('Please enter the Answer');
        return false;
    }

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById('present_reply_'+id).innerHTML=''; 

            document.getElementById('present_reply_'+id).innerHTML=xmlhttp.responseText;

            document.getElementById('ans_'+id).value='';

            var reply_new = document.getElementById('present_reply_'+id).innerHTML;
            var reply_old = document.getElementById('prev_reply_'+id);
            reply_old.innerHTML = reply_old.innerHTML+reply_new;  

            document.getElementById("present_reply_"+id).innerHTML='';
        }
    }
    xmlhttp.open("GET","reply_question.php?id="+id+"&reply_text="+reply_text+"&anoymous="+anoymous+"&table_no="+t_no,true);
    xmlhttp.send();
}


function reply_this_post(t_no,id)
{
    alert(t_no);
    var reply_text=document.getElementById("reply_"+id).value;   
    var anoymous=document.getElementById("give_reply_anoymous_"+id);

    if(anoymous.checked)
    {
        anoymous=1;
    }

    else
        anoymous=0;

    
    if(reply_text=='')
    {
        alert('Please enter the Answer');
        return false;
    }

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById('present_comments_'+id).innerHTML=''; 

            document.getElementById('present_comments_'+id).innerHTML=xmlhttp.responseText;

            document.getElementById('reply_'+id).value='';

            var reply_new = document.getElementById('present_comments_'+id).innerHTML;
            var reply_old = document.getElementById('prev_comments_'+id);
            reply_old.innerHTML = reply_old.innerHTML+reply_new;  

            document.getElementById("present_comments_"+id).innerHTML='';
        }
    }
    xmlhttp.open("GET","reply_comment.php?id="+id+"&reply_text="+reply_text+"&anoymous="+anoymous+"&table_no="+t_no,true);
    xmlhttp.send();
}

function upvote_ans(t_no,id)
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("upvote_ans_"+id).innerHTML=xmlhttp.responseText;
            change_upvotes_numb(t_no,id);
        }
    }
    xmlhttp.open("GET","add_upvote_to_reply.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}

function like_comment(t_no,id)   //changes the status of the like for the comment
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_comment_"+id).innerHTML=xmlhttp.responseText;
            change_likes_number_replies(t_no,id);
        }
    }
    xmlhttp.open("GET","add_like_to_reply.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}

function change_upvotes_numb(t_no,id)
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("upvotes_count_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_upvotes_numb.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();
}

function dnt_upvote_ans(t_no,id)
{
        alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("upvote_ans_"+id).innerHTML=xmlhttp.responseText;
            change_upvotes_numb(t_no,id);
        }
    }
    xmlhttp.open("GET","remove_upvote_to_reply.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();    
}

function dnt_like_comment(t_no,id)
{
    alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_comment_"+id).innerHTML=xmlhttp.responseText;
            change_likes_number_replies(t_no,id);
        }
    }
    xmlhttp.open("GET","remove_like_to_reply.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();   
}

function change_likes_number_replies(t_no,id)
{
    alert(t_no);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("likes_count_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_like_numb_reply.php?id="+id+"&table_no="+t_no,true);
    xmlhttp.send();   
}
</script>