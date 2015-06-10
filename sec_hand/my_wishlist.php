<html>

<?php  
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("sec_hand");
if(isset($_GET['submit'])){
	$id=$_GET['id'];
	$stmt = "UPDATE buy
		SET status = 1
		WHERE
		id = {$id}
		LIMIT 1";
	$result=mysql_query($stmt,$conn) or die(mysql_error());

}
else{
$sql="select * from buy where uid=4 and status=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$row['id']."<br>";
		echo "Name: ".$row['name']."<br>";
		echo "Category: ".$row['category']."<br>";
		echo "Cost: ".$row['expected_cost']."<br>";
		echo "Contact Number: ".$row['contact']."<br>";
		
?>		<form method="GET" action="my_wishlist.php">
		<input type="hidden" name="id" value ="<?php echo $row['id']; ?>">
		<input type="submit" name="submit" value="Got it">
		</form>
	<?php	$id++;
	echo "<hr>";
	}
	if($id==1){
		echo "No items to show! ";
	}
	
}


?>