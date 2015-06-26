<?php
include_once('connection.php');
if(isset($_POST['found'])){
$location=$_POST['location'];
if($location=="all"){
	$sql="select * from found where status=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {
		echo "<li class='collection-item avatar'>";
		echo "<i class='circle'>".$row['id']."</i>";
		echo "<span class='title'>".$row['name']."</span><p>";
		//echo "location: ".$row['location']."<br>";
		echo "Description: ".$row['item_desc']."<br>";
		echo "Date: ".$row['date_on']."<br>";
		echo "<div class='secondary-content'>";
		echo "Colour: ".$row['colour']."<br>";
		echo "Contact: ".$row['contact']."<br>";
		echo "Category:".$row['category']."</div></p>";
		echo "</li>";
		$id++;
	}

}
else {
$sql="select * from found where status=0 and location='{$location}'";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {
		echo "<li class='collection-item avatar'>";
		echo "<i class='circle'>".$row['id']."</i>";
		echo "<span class='title'>".$row['name']."</span><p>";
		//echo "location: ".$row['location']."<br>";
		echo "Description: ".$row['item_desc']."<br>";
		echo "Date: ".$row['date_on']."<br>";
		echo "<div class='secondary-content'>";
		echo "Colour: ".$row['colour']."<br>";
		echo "Contact: ".$row['contact']."<br>";
		echo "Category:".$row['category']."</div></p>";
		echo "</li>";
		$id++;
	}
}
}

?>
