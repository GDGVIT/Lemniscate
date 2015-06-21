<?php
    session_start();
        if(true)
        {
            require 'Database/sql_con.php';
            echo "</br><a href='events_page.php' title='Click here to go to Events page'>Click here to go back</a>"; 
    echo "<form action='update_event_details.php' method='POST' enctype='multipart/form-data'>";
    echo "
        <p>Enter the event's name</p></br>
        <input type='text' id='event_name' name='event_name' autocomplete='off' placeholder='Polymer' onkeypress='return isAlpha(event)'></input></br></br></br>
        
        <p>Enter the Registration number of event-organiser</p>
        <input type='text' id='reg_event' name='reg_event' autocomplete='off' placeholder='13BCE0000' onkeypress='return isRegno()'></input><br/></br></br>
        
        <p>Enter the type of the event</p>
            <input type = 'radio' value ='0' name ='event_type' checked='checked' id='club' >Club Event
            <input type = 'radio' value ='1' name ='event_type' id='indiv'>Individual Event</br></br></br>
        
        <p>Enter the name of the Event's organising club/individual name:</p>
        <input type='text' id='club_name' name='club_name' autocomplete='off' onkeypress='return isAlpha(event)'></input></br></br>
        
        <p>Picture of the Event</p>
        <input type='file' name='File_up' id='File_up' accept='image/x-png, image/gif, image/jpeg' /></br></br>
        
        <p>Description of the event</p>
        <textarea id='event_desc' name='event_desc' rows='10' cols='50' autocomplete='off' onkeypress='return isAlpha(event)'></textarea></br></br>
        
        <p>Cost of the event</p>
        <input type='text' id='cost_event' name='cost_event' autocomplete='off' onkeypress='return isNumber(event)'></input></br></br>

        <p>Are participation-certificates provided?</p>
        <input type = 'radio' value ='0' name ='part_certif' checked='checked' id='part_certif_no' >No
        <input type = 'radio' value ='1' name ='part_certif' id='part_certif_yes'>Yes</br></br></br>
        
        <p>Are On Duties provided?</p>
        <input type = 'radio' value ='0' name ='od_status' checked='checked' id='od_status_no' >No
        <input type = 'radio' value ='1' name ='od_status' id='od_status_yes'>Yes</br></br></br>
        

        <p>Enter the starting date of the event</p>
        <input type='date' id='date_from' name='date_from' autocomplete='off' onkeypress='return isNumber(event)'></input></br>

        <p>Enter the total number of days</p>
        <input type='text' id='total_no_days' name='total_no_days' autocomplete='off' onkeyup='book_id_fields()' placeholder='Eg:2,3,4' onkeypress='return isNumber(event)'></input></br></br>
        <div id='date_event'></div>         
        ";
    //file for adding fields is add_date_id_file.php
    echo "<input type='submit' value='Submit' name='submit' onclick='return verify_input()'>
    </from>";
}
?>
