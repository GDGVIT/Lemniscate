<html>

<?php
include_once('connection.php');
if(isset($_GET['submit'])){
	$id=$_GET['id'];
	$stmt = "UPDATE sell
		SET sold = 1
		WHERE
		id = {$id}
		LIMIT 1";
	$result=mysql_query($stmt,$conn) or die(mysql_error());
	header('Location: my_items.php');
}
else{
$sql="select * from sell where uid=4 and sold=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$row['id']."<br>";
		echo "Name: ".$row['name']."<br>";
		echo "Category: ".$row['category']."<br>";
		echo "Description: ".$row['description']."<br>";
		echo "Cost: ".$row['cost']."<br>";
		echo "Contact Number: ".$row['contact']."<br>";

?>		<form method="GET" action="my_items.php">
		<input type="hidden" name="id" value ="<?php echo $row['id']; ?>">
		<input type="submit" name="submit" value="Sold">

		</form>
	<?php	$id++;
	echo "<hr>";
	}
	if($id==1){
		echo "No items to show! ";
	}

}


?>
