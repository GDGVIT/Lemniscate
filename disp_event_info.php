<?php
session_start();
//if(isset(session_variable))
{
	if(isset($_REQUEST['id']))
	{
		require 'Database/sql_con.php';
		echo "</br><a href='events_page.php' title='Click here to go to Events page'>Click here to go back</a>"; 
    	$id=$_REQUEST['id'];
		$sql_event = "SELECT * FROM `events_page` WHERE unique_id=$id";
		$res_event = mysqli_query($mysqli,$sql_event);
			if(mysqli_num_rows($res_event)>0)
			{
				//there are some events in the events table and tracking count.
				$count_events=0;
				$d=date('Y-m-d');
				
				while($arr=mysqli_fetch_array($res_event))
				{
					$from_date=$arr['from_date'];
					$total_days=$arr['total_days'];
					$id=$arr['unique_id'];
					$to_date=date('Y-m-d', strtotime($from_date. ' + $total days')); 
					$completed_status=$arr['completed_status'];
					if((($d>=$from_date)||($d<=$to_date))&&($completed_status==0))
					{
						//Checking the events for today.
						$count_events++;
						$event_name = $arr['event_name'];
						$indiv_status = $arr['indiv_status'];
						$regno = $arr['regno'];
						$club_name=$arr['club_name'];
						$pic_address=$arr['pic_address'];
						$description=$arr['description'];
						$price=$arr['price'];
						$cerificates=$arr['stat_part_certificates'];
						$ods=$arr['stat_ods'];

						$sql_event_venue="SELECT * FROM `events_info` where id=$id and date_event='$d';";
						$res_event_venue=mysqli_query($mysqli,$sql_event_venue);
						if(mysqli_num_rows($res_event_venue)>0)
						{
							//if any event exsists for the given day
							while($arr_1=mysqli_fetch_array($res_event_venue))	
							{
								$venue=$arr_1['venue'];
								$from_time=$arr_1['from_time'];
								$to_time=$arr_1['to_time'];

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
								{
									$indiv_status="Club Event";
									echo "<h3>Event-name : $event_name<br/>
										Status : $indiv_status <br/>
										Club name : $club_name <br/>
										Description : $description<br/>
										Venue : $venue<br/>";
										if($room_no!=0)
										echo"Room : $room_no";
										echo"Starts at : $from_time<br/>
										Ends at : $to_time<br/>
										Picture : <img src=".$pic_address." alt='event picture' height='170px' width='170px' title=".$event_name."></img><br/>
										Providing On Duty : $ods<br/>
										Participation Certificates :$cerificates<br/>
										Price : $price<br/><br/><br/>";
								}
								else
								{
									$indiv_status="Individual Event";
									echo "<h1>Event-name : $event_name<br/>
										Status : $indiv_status <br/>
										Club name : $club_name <br/>
										Description : $description<br/>
										Venue : $venue<br/>";
										if($room_no!=0)
										echo"Room : $room_no";
										echo"Starts at : $from_time<br/>
										Ends at : $to_time<br/>
										Picture : <img src=".$pic_address." alt='event picture' height='170px' width='170px' title=".$event_name."></img><br/>
										Providing On Duty : $ods<br/>
										Participation Certificates :$cerificates<br/>
										Price : $price<br/><br/><br/>";
								}

							}
						}	
					}
				}
			}
	}
}
?>
