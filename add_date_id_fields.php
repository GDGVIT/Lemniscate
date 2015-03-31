<?php
	session_start();
		if(true)
		{
			require 'Database/sql_con.php';
			$s = $_REQUEST['no'];
			$d = $_REQUEST['date'];
			for($i =0 ;$i<$s;$i++)
			{

				$to_date=date('Y-m-d', strtotime($d.'+ '.$i.' days'));
				
				echo "Date";
				echo "<input type='date' name='date_event".$i."' id='date_event".$i."' value='".$to_date."' >";
				echo "From Time";
				echo "<input type='time' name='time_event_from".$i."' id='time_event_from".$i."' >";
				echo "To Time";
				echo "<input type='time' name='time_event_to".$i."' id='time_event_to".$i."' >";
				//dropdowns for venues
				echo "<select name='venue".$i."' id='venue".$i."'>
    					<option value='SJT'>Silver Jublie Tower (SJT)</option>
   						<option value='TT'>Technology Tower (TT)</option>
   						<option value='SMV'>SMV (Hexagon)</option>
   						<option value='MB'>Main Building(MB)</option>
   						<option value='greenos'>Greenos</option>
   						<option value='GDN'>G.D Naidu</option>
    				 </select>";
    			echo "Room no(optional)";
    			echo "<input type='text' name='room_no".$i."' id='room_no".$i."' placeholder='Enter the room number'><br/>";

			}
			mysqli_close($mysqli);
		}
		
		else
		{
			session_unset();
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
			session_destroy();
			exit();
		}
	
	
?>