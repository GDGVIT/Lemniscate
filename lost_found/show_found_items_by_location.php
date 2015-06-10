<?php  
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("db");
$location=$_GET['location'];
if($location=="all"){
	$sql="select * from found where status=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$row['id']."<br>";
		echo "Name: ".$row['name']."<br>";
		//echo "location: ".$row['location']."<br>";
		echo "Description: ".$row['item_desc']."<br>";
		echo "Date: ".$row['date_on']."<br>";
		echo "Colour: ".$row['colour']."<br>";
		echo "Contact: ".$row['contact']."<br>";
		echo "Category:".$row['category']."<br>";
		echo "<hr>";
		$id++;
	}

}
else {
$sql="select * from found where status=0 and location='{$location}'";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$row['id']."<br>";
		echo "Name: ".$row['name']."<br>";
		//echo "location: ".$row['location']."<br>";
		echo "Description: ".$row['item_desc']."<br>";
		echo "Date: ".$row['date_on']."<br>";
		echo "Colour: ".$row['colour']."<br>";
		echo "Contact: ".$row['contact']."<br>";
		echo "Category:".$row['category']."<br>";
		echo "<hr>";
		$id++;
	}
}

?>