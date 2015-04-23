<?php 
	session_start();
	if(true)//check the session variable
	{
		require 'Database/sql_con.php';
		if((isset($_REQUEST['event_venue']))&&(isset($_REQUEST['org_name']))&&(isset($_REQUEST['from_time']))&&(isset($_REQUEST['to_time'])))
		{
			$venue=$_REQUEST['event_venue'];
			$from_time=$_REQUEST['from_time'];
			$to_time=$_REQUEST['to_time'];
			$club_name=$_REQUEST['org_name'];
			$date_event=$_REQUEST['date_event'];

			/*if($venue!="all")//a button to reset venue search
			echo "<button onclick='reset_fields(1)' value='Reset venue search'></button>";

			if(($from_time!="")&&($to_time!=""))//a button to reset time search
			echo "<button onclick='reset_fields(2)' value='Reset time search'></button>";

			if($club_name!="")//a button to reset club name search
			echo "<button onclick='reset_fields(3)' value='Reset club name search'></button>";

			if($date_event!="")//a button to reset date search
			echo "<button onclick='reset_fields(4)' value='Reset date search'></button>";*/

			$date_event=mysqli_real_escape_string($mysqli,$date_event);
			$from_time=mysqli_real_escape_string($mysqli,$from_time);
			$to_time=mysqli_real_escape_string($mysqli,$to_time);

			$info=0;

			if($venue=="all")//no venue
			{
				if(($from_time=="")||($to_time==""))//no time
				{
					if($club_name=="")//no club_name
					{
						if($date_event=="")//none
						{
							
						}
						else//date_event
						{
							$info=1;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE date_event='$date_event');";
						}

					}
					else //club_name
					{	
						if($date_event=="")//club_name
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info`) AND club_name='$club_name';";
						}
						else//date,club
						{
							$info=2;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE date_event='$date_event') AND club_name='$club_name';";
						}
					}
				}
				else//time
				{
					if($club_name=="")//no club_name
					{
						if($date_event=="")//time
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time');";
						}

						else//time,date
						{
							$info=3;
							echo "Im here".$date_event;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time' AND date_event='$date_event');";
						}
						
					}
					else// club_name
					{
						if($date_event=="")//time,club_name
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time') AND club_name='$club_name';";
						}
						else//time,club_name,date
						{
							$info=4;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time' AND date_event='$date_event') AND club_name='$club_name';";
						}
					}
				}

			}

			else//venue
			{
				if(($from_time=="")||($to_time==""))//no time
				{
					if($club_name=="")//no club_name
					{
						if($date_event=='')//venue
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE venue='$venue');";
						}
						else//venue,date
						{
							$info=5;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE date_event='$date_event' AND venue='$venue');";	
						}
						
					}
					else
					{
						if($date_event=="")//venue,club_name
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE venue='$venue') AND club_name='$club_name';";
						}
						else//venue,club_name,date
						{
							$info=6;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE date_event='$date_event' AND venue='$venue') AND club_name='$club_name';";
						}

					}
				}
				else//time
				{
					if($club_name=="")//no club_name
					{
						if($date_event=="")//venue,time
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time' AND venue='$venue');";
						}
						else//venue,time,date
						{
							$info=7;
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time' AND date_event='$date_event' AND venue='$venue');";
						}
					}
					else//club_name
					{
						if($date_event=="")//venue,time,club_name
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time' AND venue='$venue') AND club_name='$club_name';";
						}
						else//venue,time,club_name,date
						{
							$sql_event="SELECT * FROM `events_page` WHERE unique_id IN(SELECT distinct id FROM `events_info` WHERE from_time>='$from_time' AND to_time<='$to_time' AND venue='$venue' AND date_event='$date_event') AND club_name='$club_name';";
						}
					}
				}
			}
		$res_details=mysqli_query($mysqli,$sql_event);
		$numb_events=mysqli_num_rows($res_details);
		if($numb_events>0)
		{	
			echo"There are in total ".$numb_events." events</br>";
			while($arr=mysqli_fetch_array($res_details))
			{
				$event_name = $arr['event_name'];
				$indiv_status = $arr['indiv_status'];
				$regno = $arr['regno'];
				$club_name=$arr['club_name'];
				$pic_address=$arr['pic_address'];
				$description=$arr['description'];
				$price=$arr['price'];
				$cerificates=$arr['stat_part_certificates'];
				$ods=$arr['stat_ods'];
				$id=$arr['unique_id'];

				if($ods==0)
					$ods="No";
				else
					$ods="Yes";

								
				if($cerificates==0)
					$cerificates="No";
				else 
					$cerificates="Yes";

				if($price==0)
					$price="Free of cost";
				else
					$price=$price;

				if($indiv_status==0)
					$indiv_status="Club Event";
				else
					$indiv_status="Individual Event";

				$sql_ex_details="SELECT * FROM `events_info` WHERE id=$id";
				$res_ex_details=mysqli_query($mysqli,$sql_ex_details);

				

				while($arr_1=mysqli_fetch_array($res_ex_details))
				{
					$fake_event=0;
					$arr_venue=$arr_1['venue'];
					$arr_from_time=$arr_1['from_time'];
					$arr_to_time=$arr_1['to_time'];
					$arr_date_event=$arr_1['date_event'];
					$res_room_no=$arr_1['room_no'];
					if($venue!="all")
					{
						if($arr_venue!=$venue)
						{
							$fake_event++;
							//echo "venue";
						}
					}
					if(($from_time!="")&&($to_time!=""))
					{
						//echo "in time";
						$from_time=$from_time.":00";
						$to_time=$to_time.":00";
						if(($arr_from_time>=$from_time)&&($arr_to_time<=$to_time))
						{
						}
						else
						{
							$fake_event++;
						}
					}
					if($date_event!='')
					{
						if($arr_date_event!=$date_event)
						{
							//echo "</br>lklklklklklkl</br>";
							$fake_event++;
							//echo "date";
						}
					}

					$d=date('Y-m-d');
					if(($fake_event==0)&&($d<=$arr_date_event))
					{
						echo"
						Name : $event_name <br/>
						Status : $indiv_status <br/>
						Club name : $club_name <br/>
						Description : $description<br/>
						Venue : $arr_venue<br/>
						Date : $arr_date_event</br>";
						if($res_room_no!=0)
							echo"Room : $res_room_no<br/>";
						echo"
						Starts at : $arr_from_time<br/>
						Ends at : $arr_to_time<br/>
						Picture : <img src=".$pic_address." alt='event picture' height='170px' width='170px' title=".$event_name."></img><br/>
						Providing On Duty : $ods<br/>
						Participation Certificates :$cerificates<br/>
						Price : $price<br/><br/><br/>";

					}	
				}
			}
		}
		else//less than 0 in number of fetching
		{
			echo "No events available for this search";
		}
	}
}
	else//logout 
	{
		
	}
?>