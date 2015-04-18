<?php
session_start();
//if(isset($_SESSION['login_variable'])
{
  if(isset($_REQUEST['event']))
  {
    require 'Database/sql_con.php';
    $event_name=$_REQUEST["event"]; 
    $event_name=strtolower($event_name);
    $len=strlen($event_name);
    
    $sql_event="SELECT * FROM `events_page`;";
    $res_event=mysqli_query($mysqli,$sql_event);

    $i=0;
    if($res_event)
    {
      while($arr = mysqli_fetch_array($res_event))
      {
        $name=$arr["event_name"];
        $id=$arr["unique_id"];
        $club_name=$arr["club_name"];
        $price=$arr["price"];
        $completed_status=$arr['completed_status'];
        $event_name=strtolower($event_name);
        $len=strlen($event_name);
        if(($len>0)&&($completed_status==0))
        {
          if(stristr($event_name, substr($name,0,$len)))
          {
            $i++;
            echo "<button><p style='font-weight:bold;' id=".$id." onclick='getdetails($id);' >".$name."<br/>Organisers:".$club_name."<br/>Price:".$price."<br/></p></button><br/>";
          }
        }  
      }
      if(($i==0)&&($len>0))
      {
        echo "No events to be displayed";
      }
    }
    else
    {
      //the select query isn't working..check the tables once
      echo "Seems there is an error in searching the event...we'll get back as soon as possible"; 
    }

  }
}
?>