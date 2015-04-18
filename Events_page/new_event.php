<?php
    session_start();
        if(true)//check the session variable
        {
            require 'Database/sql_con.php';
            echo "</br><a href='events_page.php' title='Click here to go to Events page'>Click here to go back</a>"; 
    echo "<form action='update_event_details.php' method='POST' enctype='multipart/form-data'>";
    echo "
        <br>
        <div class='input-field col s12'>
          <input id='event_name' type='text' class='validate' autocomplete='off' onkeypress='return isAlpha(event)'>
          <label for='last_name'>Event Name</label>
        </div>
        <div class='input-field col s12'>
          <input id='reg_event' name='reg_event' type='text' class='validate' autocomplete='off' onkeypress='return isRegno()'>
          <label for='last_name'>Registration number of Event Organiser</label>
        </div>
        <p>Type of the event :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
        <input name='addevent' type='radio' id='club' class='with-gap'/>
        <label for='club'>Club Event</label>
        <input name='addevent' type='radio' id='indiv' class='with-gap'/>
        <label for='indiv'>Individual Event</label>
        </p>
    	<div class='input-field col s12'>
          <input id='club_name' name='club_name' type='text' class='validate' autocomplete='off' onkeypress='return isAlpha(event)'>
          <label for='club_name'>Event Organiser's Name/Club</label>
        </div>

        <p>Event Picture : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    	<input type='file' name='File_up' id='File_up' accept='image/x-png, image/gif, image/jpeg' /></p>
    	
        <div class='input-field col s12'>
          <textarea id='event_desc' name='event_desc' class='materialize-textarea' onkeypress='return isAlpha(event)'></textarea>
          <label for='event_desc'>Event Description</label>
        </div>

        <div class='input-field col s12'>
          <input id='cost_event' name='cost_event' type='text' class='validate' autocomplete='off' onkeypress='return isNumber(event)'>
          <label for='cost_event'>Event cost</label>
        </div>
        <br>
        <p>Are participation-certificates provided ? :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
        <input name ='part_certif' type='radio' id='part_certif_no' class='with-gap' checked='true'/>
        <label for='part_certif_no'>No</label>
        <input name ='part_certif' type='radio' id='part_certif_yes' class='with-gap'/>
        <label for='part_certif_yes'>Yes</label>
        </p>

        <p>Are On Duties provided ? :   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
        <input name ='od_status' type='radio' id='od_status_no' class='with-gap' checked='true'/>
        <label for='od_status_no'>No</label>
        <input name ='od_status' type='radio' id='od_status_yes' class='with-gap'/>
        <label for='od_status_yes'>Yes</label>
        </p>
        <br>
        <p>Starting date of the event
        <input type='date' id='date_from' name='date_from' autocomplete='off' onkeypress='return isNumber(event)'></input></p>

        <div class='input-field col s12'>
          <input id='total_no_days' name='total_no_days' type='text' class='validate' autocomplete='off' onkeyup='book_id_fields()' onkeypress='return isNumber(event)'>
          <label for='cost_event'>Total number of days</label>
        </div>

        <div id='date_event'></div>			
        ";
    //file for adding fields is add_date_id_file.php
    echo "<input type='submit' value='Submit' name='submit' onclick='return verify_input()'>
    </from>";
}
else//logout
{
        session_unset();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        session_destroy();
        header("Location:login.php");
        exit();
}
?>