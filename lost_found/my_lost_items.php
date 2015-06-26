<html>

<?php
include_once('connection.php');
if(isset($_GET['submit'])){
	$id=$_GET['id'];
	$stmt = "UPDATE lost
		SET status = 1
		WHERE
		id = {$id}
		LIMIT 1";
	$result=mysql_query($stmt,$conn) or die(mysql_error());
	header('Location: my_lost_items.php');
}
else{
$sql="select * from lost where user_id=4 and status=0";
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


		// echo "Cost: ".$row['cost']."<br>";
		// echo "Contact Number: ".$row['contact']."<br>";

?>		<form method="GET" action="my_lost_items.php">
		<input type="hidden" name="id" value ="<?php echo $row['id']; ?>">
		<input type="submit" name="submit" value="Found">

		</form>
	<?php	$id++;
	echo "</li>";
	}
	if($id==1){
		echo "No items to show! ";
	}

}
