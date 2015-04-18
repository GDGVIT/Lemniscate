<?php
//disc-wall
    session_start();
    if(!isset($_SESSION['user']))
    {
        $_SESSION['user']='13BCE0267';
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
    	
    	<button onclick='add_post(1)' name='add_question'>Add as Question</button><br/><br/>
    	<button onclick='add_post(0)' name='add_post'>Add as Post</button><br/>";

    	echo "<input type='radio' name='anoymous' id='not_anoymous' value='0' checked='checked'>Post with Name</input>";
    	echo "<input type='radio' name='anoymous' id='anoymous' value='1'>Post as Anoymous</input>
        <hr><h4>POSTS</h4><hr>";
        
        echo "<div id='new_post' name='new_post'></div>";

    	echo "<div id='posts_display'>";
        $sql_display="SELECT * FROM `post_table` ORDER BY date_time desc LIMIT 0, 15";
        $res_display=mysqli_query($mysqli,$sql_display);
        if(mysqli_num_rows($res_display)>0)
        {
            while($arr=mysqli_fetch_array($res_display))//need to get the ans of the respective indiv and also the like status
            {                                           //so that we wont like again..replies will be timing ordered for posts
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
                    //total no.of people who want ans
                    //check the status of the like from the respective table and show accordingly
                    
                    $sql_ans_req_count="SELECT no_of_likes_ans FROM `post_table` WHERE unique_id='$post_id';";
                    $res_ans_req_count=mysqli_query($mysqli,$sql_ans_req_count);
                    if(mysqli_num_rows($res_ans_req_count)==1)
                    {
                        while($count=mysqli_fetch_array($res_ans_req_count))
                        { 
                            $count_ans_req=$count['no_of_likes_ans'];
                            echo "<div id='numb_ans_".$post_id."'>Number of people who require answer are ".$count_ans_req."</div>";
                        }
                    } 

                    $sql_ans_req_stat="SELECT * FROM `ans_req_likes` WHERE qstn_id='$post_id' AND req_ans_reg_no='$login_name'";
                    $res_ans_req_stat=mysqli_query($mysqli,$sql_ans_req_stat);
                    if(mysqli_num_rows($res_ans_req_stat)==0)
                        echo "<div id='want_ans_".$post_id."'><button onclick='ans_req(this.id)' id='$post_id' >Even I need the answer</button></div><br/>";
                    else //revert back requiring the answer 
                        echo "<div id='want_ans_".$post_id."'><button onclick='dnt_req_ans(this.id)' id='$post_id' >I don't wanna know answer</button></div><br/>";


                    //total no.of people who require ans
                    //check the upvotes status and arrange the replies accordingly 
                    
                    $count_replies=0;

                    $sql_ans_replies="SELECT * FROM `reply_posts` WHERE comment_id='$post_id' ORDER BY likes_upvotes desc";
                    $res_ans_replies=mysqli_query($mysqli,$sql_ans_replies);
                    {
                        if($res_ans_req_count)
                        {
                            echo "<div id='prev_reply_".$post_id."'>";  //div for previous replies
                                
                            while($reply_arr=mysqli_fetch_array($res_ans_replies))
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

                                $sql_upvote_stat="SELECT * FROM `likes_upvotes` WHERE unique_id_post='$unique_reply' AND regno_liked='$login_name'";
                                $res_upvote_stat=mysqli_query($mysqli,$sql_upvote_stat);
                                if(mysqli_num_rows($res_upvote_stat)==0)
                                    echo "<div id='upvote_ans_".$unique_reply."'><button onclick='upvote_ans(this.id)' id='$unique_reply' >Upvote</button></div><br/>";
                                else //revert back requiring the answer 
                                    echo "<div id='upvote_ans_".$unique_reply."'><button onclick='dnt_upvote_ans(this.id)' id='$unique_reply' >Don't wanna upvote</button></div><br/>";

                            }
                            echo "</div>";
                        }
                        
                    }

                    //div for present replies
                    echo "<div id='present_reply_".$post_id."'>  
                    </div>";
                    //change it from here...else for select all should be here
                                if($count_replies==0)
                                {
                                    echo "<div id='ans_this_".$post_id."'>
                                        <textarea id='ans_".$post_id."' placeholder='Type your answer here' ></textarea> 
                                        <input type='checkbox' name='reply_anoymous' id='reply_anoymous_".$post_id."' value='1' >Post as anoymous</input><br/>       
                                        <button onclick='ans_this_qstn(this.id)' id='$post_id'>Sumbit Answer</button>
                                      </div>

                                      </br></br></br>";
                                }
                }



                else //posts
                {
                    $sql_ans_req_count="SELECT no_of_likes_ans FROM `post_table` WHERE unique_id='$post_id';";
                    $res_ans_req_count=mysqli_query($mysqli,$sql_ans_req_count);
                    if(mysqli_num_rows($res_ans_req_count)==1)
                    {
                        while($count=mysqli_fetch_array($res_ans_req_count))
                        { 
                            $count_ans_req=$count['no_of_likes_ans'];//changed
                            echo "<div id='numb_like_".$post_id."'>Number of people who like are ".$count_ans_req."</div>";
                        }
                    } 

                    $sql_ans_req_stat="SELECT * FROM `ans_req_likes` WHERE qstn_id='$post_id' AND req_ans_reg_no='$login_name'";
                    $res_ans_req_stat=mysqli_query($mysqli,$sql_ans_req_stat);
                    if(mysqli_num_rows($res_ans_req_stat)==0)//changedt
                        echo "<div id='like_ans_".$post_id."'><button onclick='like_this(this.id)' id='$post_id' >I like it</button></div><br/>";
                    else //revert back requiring the answer 
                        echo "<div id='like_ans_".$post_id."'><button onclick='dnt_like_this(this.id)' id='$post_id' >I don't like it anymore</button></div><br/>";

                    $count_replies=0;

                    $sql_ans_replies="SELECT * FROM `reply_posts` WHERE comment_id='$post_id' ORDER BY date_reply";
                    $res_ans_replies=mysqli_query($mysqli,$sql_ans_replies);
                    {
                        if($res_ans_req_count)
                        {
                            //changed
                            echo "<div id='prev_comments_".$post_id."'>";  //div for previous replies
                                
                            while($reply_arr=mysqli_fetch_array($res_ans_replies))
                            {
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

                                $sql_upvote_stat="SELECT * FROM `likes_upvotes` WHERE unique_id_post='$unique_reply' AND regno_liked='$login_name'";
                                $res_upvote_stat=mysqli_query($mysqli,$sql_upvote_stat);
                                if(mysqli_num_rows($res_upvote_stat)==0)//changed
                                    echo "<div id='like_comment_".$unique_reply."'><button onclick='like_comment(this.id)' id='$unique_reply' >Like the reply</button></div><br/>";
                                else //revert back requiring the answer 
                                    echo "<div id='like_comment_".$unique_reply."'><button onclick='dnt_like_comment(this.id)' id='$unique_reply' >I Don't like the reply anymore</button></div><br/>";

                            }
                            echo "</div>";
                        }
                        
                    }

                    //div for present replies
                    echo "<div id='present_comments_".$post_id."'> 
                    </div>";
                     if($count_replies==0)
                                {
                                    //changed a lot
                                    echo "<div id='reply_this_".$post_id."'>
                                        <textarea id='reply_".$post_id."' placeholder='Type your answer here' ></textarea> 
                                        <input type='checkbox' name='reply_anoymous' id='give_reply_anoymous_".$post_id."' value='1' >Post as anoymous</input><br/>       
                                        <button onclick='reply_this_post(this.id)' id='$post_id'>Sumbit Answer</button>
                                      </div>

                                      </br></br></br>";
                                }
                }

            }
        }
        else//no new news feed 
        {

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
function add_post(id)
{
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
 	xmlhttp.open("GET","add_post.php?post="+post_user+"&status_post="+id+"&anoymous="+value_anoymous,true);
 	xmlhttp.send();
}

function ans_req(id)    //answer required for a question
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("want_ans_"+id).innerHTML=xmlhttp.responseText;
            change_numb(id);
        }
    }
    xmlhttp.open("GET","add_req_qstn.php?id="+id,true);
    xmlhttp.send();
}


function like_this(id)      //like the given post
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_ans_"+id).innerHTML=xmlhttp.responseText;
            like_change_numb(id);
        }
    }
    xmlhttp.open("GET","add_like_post.php?id="+id,true);
    xmlhttp.send();
}



function change_numb(id)  //change the total number of number of ans
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("numb_ans_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_numb.php?id="+id,true);
    xmlhttp.send();
}



function dnt_req_ans(id)   //don't require an answer for a question
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("want_ans_"+id).innerHTML=xmlhttp.responseText;
            change_numb(id);
        }
    }
    xmlhttp.open("GET","remove_req_qstn.php?id="+id,true);
    xmlhttp.send();
}

function dnt_like_this(id)      //unlike the post
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_ans_"+id).innerHTML=xmlhttp.responseText;
         like_change_numb(id);
        }
    }
    xmlhttp.open("GET","remove_like_post.php?id="+id,true);
    xmlhttp.send();

}

function like_change_numb(id)   //changes the post's like number 
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("numb_like_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_numb_likes.php?id="+id,true);
    xmlhttp.send();    
}

function ans_this_qstn(id)
{
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
    xmlhttp.open("GET","reply_question.php?id="+id+"&reply_text="+reply_text+"&anoymous="+anoymous,true);
    xmlhttp.send();
}


function reply_this_post(id)
{

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
    xmlhttp.open("GET","reply_comment.php?id="+id+"&reply_text="+reply_text+"&anoymous="+anoymous,true);
    xmlhttp.send();
}

function upvote_ans(id)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("upvote_ans_"+id).innerHTML=xmlhttp.responseText;
            change_upvotes_numb(id);
        }
    }
    xmlhttp.open("GET","add_upvote_to_reply.php?id="+id,true);
    xmlhttp.send();
}

function like_comment(id)   //changes the status of the like for the comment
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_comment_"+id).innerHTML=xmlhttp.responseText;
            change_likes_number_replies(id);
        }
    }
    xmlhttp.open("GET","add_like_to_reply.php?id="+id,true);
    xmlhttp.send();
}

function change_upvotes_numb(id)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("upvotes_count_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_upvotes_numb.php?id="+id,true);
    xmlhttp.send();
}

function dnt_upvote_ans(id)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("upvote_ans_"+id).innerHTML=xmlhttp.responseText;
            change_upvotes_numb(id);
        }
    }
    xmlhttp.open("GET","remove_upvote_to_reply.php?id="+id,true);
    xmlhttp.send();    
}

function dnt_like_comment(id)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("like_comment_"+id).innerHTML=xmlhttp.responseText;
            change_likes_number_replies(id);
        }
    }
    xmlhttp.open("GET","remove_like_to_reply.php?id="+id,true);
    xmlhttp.send();   
}

function change_likes_number_replies(id)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("likes_count_"+id).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","change_like_numb_reply.php?id="+id,true);
    xmlhttp.send();   
}
</script>