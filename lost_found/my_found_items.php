<html>

<?php  
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("lemniscate");
if(isset($_GET['submit'])){
	$id=$_GET['id'];
	$stmt = "UPDATE found
		SET status = 1
		WHERE
		id = {$id}
		LIMIT 1";
	$result=mysql_query($stmt,$conn) or die(mysql_error());
	header('Location: my_found_items.php');
}
else{
$sql="select * from found where user_id=4 and status=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$row['id']."<br>";
		echo "Name: ".$row['name']."<br>";
		//echo "Category: ".$row['category']."<br>";
		echo "Description: ".$row['item_desc']."<br>";
		echo "Handed over to: ".$row['handed_over']."<br>";		
		echo "Date: ".$row['date_on']."<br>";
		echo "Colour: ".$row['colour']."<br>";
		echo "Contact: ".$row['contact']."<br>";
		
		
		// echo "Cost: ".$row['cost']."<br>";
		// echo "Contact Number: ".$row['contact']."<br>";
		
?>		<form method="GET" action="my_found_items.php">
		<input type="hidden" name="id" value ="<?php echo $row['id']; ?>">
		<input type="submit" name="submit" value="Given to the concerned person">

		</form>
	<?php	$id++;
	echo "<hr>";
	}
	if($id==1){
		echo "No items to show! ";
	}

}