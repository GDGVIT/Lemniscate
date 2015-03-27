<?php
session_start();
	//Seaching all events according to cost ,time and also w.r.t to the location.
	if(true)//isset($_SESSION['id'])
	{
		require 'Database/sql_con.php';
		echo "<div id='display'>";
		{
			echo "<input type='button' value='Add an Event' onclick='add_event()' title='Click here to add an event'></input>";
			
			echo "<div id='event_filter'>";

			//name 
			echo "<input type='text' id='name_event' onkey ";

			$sql_event = "SELECT * FROM `events_page`";
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

								
								if($indiv_status==0)
								{
									$indiv_status="Club Event";
									echo "<h3>Event-name : $event_name<br/>
										Status : $indiv_status <br/>
										Club name : $club_name <br/>
										Description : $description<br/>
										Venue : $venue<br/>
										Starts at : $from_time<br/>
										Ends at : $to_time<br/>
										Picture : <img src=".$pic_address." alt='event picture' height='170px' width='170px' title=".$event_name."></img><br/>
										Providing On Duty : $ods<br/>
										Participation Certificates :$cerificates<br/>
										Price : $price<br/>";
								}
								else
								{
									$indiv_status="Individual Event";
									echo "<h1>Event-name : $event_name<br/>
										Status : $indiv_status <br/>
										Club name : $club_name <br/>
										Description : $description<br/>
										Venue : $venue<br/>
										Starts at : $from_time<br/>
										Ends at : $to_time<br/>
										Picture : <img src=".$pic_address." alt='event picture' height='170px' width='170px' title=".$event_name."></img><br/>
										Providing On Duty : $ods<br/>
										Participation Certificates :$cerificates<br/>
										Price : $price<br/>";
								}

							}
						}	
					}
					else if(($d>$to_date)&&($completed_status==0))
					{
						//setting completed status for the completed events
						$sql_complete="UPDATE `events_page` SET `completed_status`=1 WHERE `unique_id`=$id;";
						$res_complete=mysqli_query($mysqli,$sql_complete);
						if($res_complete==false)
						{
							echo "Status for completed events isn't changed";
						}

					}
						
				}
			}
			else
			{
				//there are no events in the events table.
				echo "<h1>No Events to display</h1>";
			}
		}
		echo"</div>";//Events filter div
	echo"</div>";//complete page ajax
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


function isNumber(evt)  
{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
             return false;
        return true;
}

function isRegno()
{
	var regno = document.getElementById("regno").value;
	var pattern = /^[0-1]{1}[0-9]{1}[a-zA-Z]{3}[0-9]{4}$/;
	if(!regno.match(pattern))
	{
		$er="Enter a valid Regno";
		document.getElementById("regnoer").innerHTML = $er;
	}
	else
	{
		document.getElementById("regnoer").innerHTML = "";
	}
}

function book_id_fields()
{
var s = document.getElementById("total_no_days").value
var d = document.getElementById("date_from").value;


if(d=="")
{	
	alert('Please Enter from date');
	document.getElementById('date_from').focus();
	return false;
}

var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  	{
    	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
      		document.getElementById("date_event").innerHTML=xmlhttp.responseText;
    	}
  	}
 xmlhttp.open("GET","add_date_id_fields.php?no="+s+"&date="+d,true);
 xmlhttp.send();
}

function isAlpha(evt)
{
       	var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 32 && charCode != 46 && charCode > 31 && (charCode < 97 || charCode > 122)&& (charCode < 65 || charCode > 90))
             return false;
        return true;
}

function verify_input ()
{
	//if anything is null give a notification
	//need to work on it
	 var input, file;

    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)
    if (!window.FileReader) {
        alert("The file API isn't supported on this browser yet.");
        return;
    }

    input = document.getElementById('File_up');
    if (!input) {
        alert("Um, couldn't find the fileinput element.");
    }
    else if (!input.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
    }
    else if (!input.files[0]) {
        alert("Please select a file before clicking 'Load'");
    }
    else {
        file = input.files[0];
        file.name;
        if(file.size> 1048576)
        {
        	alert("File size should be less than 1MB");
    		return false;
    	}
    }

}

function add_event()
{
 	var xmlhttp=new XMLHttpRequest();
  	xmlhttp.onreadystatechange=function()
  	{
    	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
      		document.getElementById("display").innerHTML=xmlhttp.responseText;
		}
  	}
  xmlhttp.open("GET","new_event.php",true);
  xmlhttp.send();
}
</script>