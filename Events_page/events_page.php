<html>
<head>
<link rel="stylesheet" href="../css/materialize.min.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script>
$(document).ready(function() {
	$('select').material_select();
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15 // Creates a dropdown of 15 years to control year
	});
});


</script>
<?php
session_start();
	//Seaching all events according to cost ,time and also w.r.t to the location.
	if(true)//isset($_SESSION['id'])
	{
		require 'Database/sql_con.php';
		echo "<div id='display' align='center'>";
		{
			echo "<div class='stitle'>Events search<a style='float:right;' onclick='add_event()' class='btn-floating btn-large waves-effect waves-light red'><i class='mdi-content-add'></i></a></div><br>";
			echo "<div class='row'>
                  <div class='col s12'>
                    <ul class='tabs'>
                      <li class='tab col s3'><a href='#test1'>Name</a></li>
                      <li class='tab col s3'><a href='#test2'>Organiser's name</a></li>
                      <li class='tab col s3'><a href='#test3'>Date & Time</a></li>
                      <li class='tab col s3'><a href='#test4'>Venue</a></li>
                    </ul>
                  </div>";

    //Events Filter


    //By Event Name

    echo"<div id='test1' class='col s12'><br><br><br><br><div class='input-field col s6 offset-s3'>
          <input id='name_event' type='text' onkeyup='showHint(this.value)'>
          <label for='name_event'>Event Name</label>
          </div>
          </div>";


    //By Organiser's Name

    echo"<div id='test2' class='col s12'>
         <div class='input-field col s6 offset-s3'><br><br><br><br>";

         $sql_club = "SELECT * FROM `events_page`";
  	     $res_club = mysqli_query($mysqli,$sql_club);
         if(mysqli_num_rows($res_club)>0)
			{
				$d=date('Y-m-d');
				echo"<select name='club_event_search' id='club_event_search' onchange='event_filtering()'>";
                echo "<option value='0' id='event_none'>Choose anyone</option>";
				while($club=mysqli_fetch_array($res_club))
				{
					$search_club=$club['club_name'];
					echo "<option value='$search_club' id='$search_club' >$search_club</option>";
				}
				echo"</select>";
			}
				echo"</div></div>";


    //By Date & Time

    echo"<div id='test3' class='input-field col s6 offset-s3'><br><br><br>";
    $d=date('Y-m-d');
    echo "<div class='input-field col s12'>
          <input id='search_event_date' type='date' value=".$d." name='search_event_date' class='datepicker' onchange='event_filtering()'>
          </div>";
    echo "<br><br><br><h6>From Time : </h6><input type='time' id='search_event_time_from' name='search_event_time_from' onchange='event_filtering()''>";
	echo "<h6>To Time : </h6><input type='time' id='search_event_time_to' name='search_event_time_to' onchange='event_filtering()''>";
	echo "</div>";


    //By Venue

    echo "<div id='test4' class='col s12 '><div class='input-field col s6 offset-s3'><br><br><br><br>";
          echo "<select name='search_event_venue' onchange='event_filtering()' id='search_event_venue'>
						<option value='0' id='event_none'>Choose anyone</option>
    					<option value='SJT'>Silver Jublie Tower (SJT)</option>
   						<option value='TT'>Technology Tower (TT)</option>
   						<option value='SMV'>SMV (Hexagon)</option>
   						<option value='MB'>Main Building(MB)</option>
   						<option value='greenos'>Greenos</option>
   						<option value='GDN'>G.D Naidu</option>
    				 </select>";
    echo"</div></div></div>";

	//Filtering Ends

    //Results


			echo "<div id='event_filter'>";
			echo "<div id='hint'>";
			echo "</div>";

    //Results Ends




    		echo "<div id='disp_events'>";
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
					$to_date=date('Y-m-d', strtotime($from_date .'+'. $total_days .'days'));
					$completed_status=$arr['completed_status'];
					if((($d>=$from_date)&&($d<=$to_date))&&($completed_status==0))
					{
						//Checking the events for today.
						//echo "Im here"."</br>".$d."</br>".$from_date."</br>".$to_date."</br>";
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
								$room_no=$arr_1['room_no'];
								//venues must be given full names

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
										echo"Room : $room_no<br/>";
										echo"
										Starts at : $from_time<br/>
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
										echo"Room : $room_no<br/>";
										echo"
										Starts at : $from_time<br/>
										Ends at : $to_time<br/>
										Picture : <img src=".$pic_address." alt='event picture' height='170px' width='170px' title=".$event_name."></img><br/>
										Providing On Duty : $ods<br/>
										Participation Certificates :$cerificates<br/>
										Price : $price<br/><br/><br/>";
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
		echo"</div>";//events dispalying div is completed here
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

function showHint(str)
{
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("hint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","disp_event_by_name.php?event="+str,true);
  xmlhttp.send();
}


function getdetails(id)
{
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("event_filter").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","disp_event_info.php?id="+id,true);
  xmlhttp.send();
}


function event_filtering()
{
	var	event_name_id = document.getElementById("club_event_search").value;

	if(event_name_id=='0')//dnt take the value of event oganiser's name
	{
		sending_org_id="";
	}
	else
	{
		sending_org_id=event_name_id;
	}


	var event_date_id=document.getElementById('search_event_date').value;

	var date_today=new Date();

	var dd = date_today.getDate();
	var mm = date_today.getMonth()+1; //January is 0!
	var yyyy = date_today.getFullYear();

	if(dd<10)
	{
	    dd='0'+dd
	}

	if(mm<10)
	{
	    mm='0'+mm
	}

	date_today=yyyy+'-'+mm+'-'+dd;//gets the data in php format

	if(date_today==event_date_id) //dnt take the event's date for searching
	{
		sending_date=event_date_id;
	}
	else
	{
		sending_date=event_date_id;
	}

	//time
	var from_time_search=document.getElementById('search_event_time_from').value;
	var to_time_search=document.getElementById('search_event_time_to').value;

	if((to_time_search!="")&&(from_time_search!="")&&(to_time_search<from_time_search))
		alert("Wrong Timing..To timing should be greater than From timing");

	else if((to_time_search!="")&&(from_time_search!=""))
	{
 		sendind_to_time=to_time_search;
 		sending_from_time=from_time_search;
	}

	else if((to_time_search=="")&&(from_time_search==""))
	{
		sendind_to_time="";
 		sending_from_time="";
	}

	//venue
	var venue_search=document.getElementById('search_event_venue').value;
	if(venue_search=='0')
	{
		sending_venue="all";
	}
	else
	{
		sending_venue=venue_search;
	}

  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
 {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("disp_events").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","event_filter.php?event_venue="+sending_venue+"&org_name="+sending_org_id+"&from_time="+sending_from_time+"&to_time="+sendind_to_time+"&date_event="+sending_date,true);
  xmlhttp.send();
}

function reset_details(id)
{
	/*if(id==1)//venue
		document.getElementById("club_event_search").value='';

	if(id==2)//time
		document.getElementById('search_event_time_from').value;
		document.getElementById('search_event_time_to').value;

	if(id==3)//club_name

	if(id==4)//date
	*/

}

</script>
</body>
</html>
