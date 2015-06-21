<?php
    session_start();
        if(true)
        {
            require 'Database/sql_con.php';
            echo "</br><a href='events_page.php'>Click here to go back</a><br><br>"; 
    echo "<div class='row'><form class='col s12' action='update_event_details.php' method='POST' enctype='multipart/form-data'>";
    echo "<div class='col s12 offset-s3'>
          <div class='row'>
          <div class='input-field col s6'>
           <input id='event_name' type='text' class='validate' onkeypress='return isAlpha(event)'>
           <label for='event_name'>Event Name</label>
          </div>
          </div>
 
          <div class='row'>
          <div class='input-field col s6'>
           <input id='reg_event' type='text' class='validate' onkeypress='return isRegno()'>
           <label for='reg_event'>Registration number of event-organiser</label>
          </div>
          </div>

          <p>Event type :</p>
          <p>
          <input name='event_type' type='radio' id='club' value='0'/>
          <label for='club'>Club Event</label>
          </p>
          <p>
          <input name='event_type' type='radio' id='indiv' value='1'/>
          <label for='indiv'>Individual Event</label>
          </p>

          <div class='row'>
          <div class='input-field col s6'>
           <input id='club_name' type='text' class='validate' name='club_name'  onkeypress='return isAlpha(event)'>
           <label for='club_name'>Event organising club/individual name</label>
          </div>
          </div>
          
          <div class='row'>
          <div class='input-field col s6'>
          <p>Event picture : </p>
          <input type='file' name='File_up' id='File_up' accept='image/x-png, image/gif, image/jpeg' />
          </div>
          </div>
          
          <div class='row'>
          <div class='input-field col s6'>
          <textarea id='event_desc' name='event_desc' class='materialize-textarea' onkeypress='return isAlpha(event)' style='float:left'></textarea>
          <label for='event_desc'>Event description</label>
          </div>
          </div>

          <div class='row'>
          <div class='input-field col s6'>
           <input id='cost_event' type='number' class='validate' name='cost_event' onkeypress='return isNumber(event)'>
           <label for='cost_event'>Event cost</label>
          </div>
          </div>

          <p>Are participation-certificates provided ?</p>
          <p>
          <input name ='part_certif' type='radio' id='part_certif_yes' value='1'/>
          <label for='part_certif_yes'>Yes</label>
          </p>
          <p>
          <input name ='part_certif' type='radio' id='part_certif_no' value='0'/>
          <label for='part_certif_no'>No</label>
          </p>

          <p>Are On Duties provided ?</p>
          <p>
          <input name ='od_status' type='radio' id='od_status_yes' value='1'/>
          <label for='od_status_yes'>Club Event</label>
          </p>
          <p>
          <input name ='od_status' type='radio' id='od_status_no' value='0'/>
          <label for='od_status_no'>Individual Event</label>
          </p>

          <div class='row'>
          <div class='input-field col s6'>
           <input id='date_from' type='date' class='validate' name='date_from' placeholder='Starting date of the event (yyyymmdd)'onkeypress='return isNumber(event)'>
          </div>
          </div>
          
          <div class='row'>
          <div class='input-field col s6'>
           <input id='total_no_days' type='number' class='validate' name='total_no_days' onkeyup='book_id_fields()' onkeypress='return isNumber(event)'>
           <label for='total_no_days'>Total number of days</label>
          </div>
          </div>

          <div id='date_event'></div>

          </div>

       
        ";
    //file for adding fields is add_date_id_file.php
    echo "  <a class='waves-effect waves-light btn-flat blue white-text' type='submit' name='action' name='submit' onclick='return verify_input()'>Create Event
           <i class='mdi-content-send right'></i>
           </a>
           </form></div>";
}
?>
