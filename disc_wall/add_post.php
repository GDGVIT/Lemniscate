<?php
if(true)			
{
	session_start();
	require 'Database/sql_con.php';
	date_default_timezone_set('Asia/Calcutta');
	$post=$_REQUEST['post'];
	$user_name=$_SESSION['user'];
	$status_post=$_REQUEST['status_post'];
	$anoymous_status=$_REQUEST['anoymous'];

	$d=date('Y-m-d G:i:s');//T for the TimeZone

	$pic_address_ins='';

	$File_dir="Pics_in_group\\";
	if(isset($_FILES['name']))
	{
	foreach ($_FILES as $file_name=>$file_array)
	{
		$file_array['name']=str_replace(" ","",$file_array['name']);
		$name = $file_array['name'];
		$type = $file_array['type'];
		if(is_uploaded_file($file_array['tmp_name']));
		{
			move_uploaded_file($file_array['tmp_name'],"$File_dir/".$file_array['name'])or die("couldn't copy");
			//echo "file is moved";
		}
	}
	$pic_address_ins='$File_dir/$name';
	echo $pic_address_ins;
	}

	if($pic_address_ins=='')
		$pic_address_ins='';

	//echo $post." ".$user_name." ".$status_post." ".$anoymous_status;

	$sql_insert="INSERT INTO `db`.`post_table` (`regno`, `post_text`, `no_of_likes_ans`, `status_qstn`, `date_time`, `pic_address`, `anoymous_status`, `total_no_replies`) VALUES ('$user_name', '$post', '0', '$status_post', '$d', '', '$anoymous_status', '0');";
	$res_insert=mysqli_query($mysqli,$sql_insert);
	if($res_insert)
	{
		//echo"Im here";
		echo 'Post added sucessfully!';
		$sql_display="SELECT * FROM `post_table` WHERE regno='$user_name' AND date_time='$d'";
		$res_display=mysqli_query($mysqli,$sql_display);
		if(mysqli_num_rows($res_display)==1)
		{
			while($arr=mysqli_fetch_array($res_display))//need to get the ans of the respective indiv and also the like status
			{											//so that we wont like again..replies will be timing ordered for posts
				$name=$arr['regno'];					// and w.r.t total no of upvotes for question tags
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
                	echo "<div id='numb_ans_".$post_id."'>Number of people who require answer are 0</div>";    
                    echo "<div id='want_ans_".$post_id."'><button onclick='ans_req(this.id)' id='$post_id' >Even I need the answer</button></div><br/>";
                    //text field for asking questions
                    

                    echo "<div id='prev_reply_".$post_id."'></div>";

                    echo "<div id='present_reply_".$post_id."'>  
                    </div>";

                    echo "<div id='ans_this_".$post_id."'>
                                        <textarea id='ans_".$post_id."' placeholder='Type your answer here'></textarea> 
                                        <input type='checkbox' name='reply_anoymous' id='reply_anoymous_".$post_id."' value='1' >Post as anoymous</input><br/>       
                                        <button onclick='ans_this_qstn(this.id)' id='$post_id'>Sumbit Answer</button>
                                      </div>";
                }


                else //add the repective things for the post
                {
                	echo "<div id='numb_like_".$post_id."'>Number of people who like are 0</div>";
                	echo "<div id='like_ans_".$post_id."'><button onclick='like_this(this.id)' id='$post_id' >I like it</button></div><br/>";
                    
                    echo "<div id='prev_comments_".$post_id."'></div>";
                    
                    echo "<div id='present_comments_".$post_id."'></div>";

                    echo "<div id='reply_this_".$post_id."'>
                                        <textarea id='reply_".$post_id."' placeholder='Type your answer here' ></textarea> 
                                        <input type='checkbox' name='reply_anoymous' id='give_reply_anoymous_".$post_id."' value='1' >Post as anoymous</input><br/>       
                                        <button onclick='reply_this_post(this.id)' id='$post_id'>Sumbit Answer</button>
                                      </div>

                                      </br></br></br>";
					}

			}
		}
		else
		{
			echo "Cannot get the posts";
		}
	}
	else
	{
		echo "Not insterted";
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