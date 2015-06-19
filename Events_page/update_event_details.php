<?php

session_start();
if(isset($_POST['submit']))//session variable checking
{
	require 'Database/sql_con.php';
	$File_dir="Event_pics\\";
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
		$date_event=array();
		$time_event_from=array();
		$time_event_to=array();
		$venues=array();
		$room_no=array();


		if(isset($_POST['event_name'])&&isset($_POST['event_type']))
		{
			echo "Im here";
			$event_name=$_POST['event_name'];
			$reg_event=$_POST['reg_event'];
			$event_type=$_POST['event_type'];
			$club_name=$_POST['club_name'];
			$desc=$_POST['event_desc'];
			$cost_event=$_POST['cost_event'];
			$part_certif=$_POST['part_certif'];
			$od_status=$_POST['od_status'];
			$date_from=$_POST['date_from'];
			$total_no_days=$_POST['total_no_days'];
		}

		echo "<h1>".$event_name.$reg_event.$event_type.$club_name.$desc.$cost_event.$part_certif.$od_status.$date_from.$total_no_days."</h1>";

		for($i=0;$i<$total_no_days;$i++)
		{
			$date_event[$i]=$_POST["date_event".$i.""];
			$time_event_from[$i]=$_POST["time_event_from".$i.""];
			$time_event_to[$i]=$_POST["time_event_to".$i.""];
			$venues[$i]=$_POST["venue".$i.""];
			$room_no[$i]=$_POST["room_no".$i.""];
		}

		echo "<a href='events_page.php' alt='Click here to go back' title='Event's page>Click here to go to event's page</a>";
		$reg_event=mysqli_real_escape_string($mysqli,$reg_event);
		$event_type=mysqli_real_escape_string($mysqli,$event_type);
		$cost_event=mysqli_real_escape_string($mysqli,$cost_event);
		$part_certif=mysqli_real_escape_string($mysqli,$part_certif);
		$od_status=mysqli_real_escape_string($mysqli,$od_status);
		$date_from=mysqli_real_escape_string($mysqli,$date_from);
		$total_no_days=mysqli_real_escape_string($mysqli,$total_no_days);
			

		$sql_add_event="INSERT INTO `events_page`(regno,indiv_status,club_name,event_name,pic_address,description,from_date,price,total_days,stat_part_certificates,completed_status,stat_ods) VALUES('$reg_event',$event_type,'$club_name','$event_name','$File_dir/$name','$desc','$date_from',$cost_event,$total_no_days,$part_certif,0,$od_status);";
		$res_add_event=mysqli_query($mysqli,$sql_add_event);

		$flag=0;//flag variable to check the insertion

		if($res_add_event)
		{

			$sql_get_event_id="SELECT unique_id FROM `events_page` WHERE event_name='$event_name';";
			$res_get_event_id=mysqli_query($mysqli,$sql_get_event_id);


			if(mysqli_num_rows($res_get_event_id)>0)
			{	
				while($arr_1=mysqli_fetch_array($res_get_event_id))
				{
					$id_event=$arr_1['unique_id'];

					for($i=0;$i<$total_no_days;$i++)
					{			
						if($room_no[$i]!="")
						$sql_3 ="INSERT INTO `events_info`(id,date_event,venue,from_time,to_time,room_no) VALUES($id_event,'$date_event[$i]','$venues[$i]','$time_event_from[$i]','$time_event_to[$i]',$room_no[$i])"; 
						
						else
						$sql_3 ="INSERT INTO `events_info`(id,date_event,venue,from_time,to_time,room_no) VALUES($id_event,'$date_event[$i]','$venues[$i]','$time_event_from[$i]','$time_event_to[$i]',0)"; 
							
						$rs = mysqli_query($mysqli,$sql_3);
						if($rs==true)
						{
							continue;
						}
						else
						{
							$flag = 1;
							break;
						}
					}
							
					if($flag==1)
					{
						for($j=0;$j<$i;$j++)
						{
							$sqlr_3 ="DELETE FROM `events_info` WHERE id=$id_event"; 
							mysqli_query($mysqli,$sqlr_3);
						}
						$sqlr_2="DELETE FROM `events_page` WHERE id=$id_event";
						mysqli_query($mysqli,$sqlr_2);
						echo "<h3>OOPS, There was a problem in registering!</h3> ";
					}

					else
					{
						echo "<h3>Event succesfully added!</h3>";
					}
				}
			}
			else
			{
				echo "<h3>OOPS, There was a problem in registering! Please try again</h3>";
			}
		}
		else
		{
			echo "<h1>Event wasn't inserted!</h1>";
		}
	
	} 	

}
?>