<?php  
$conn=mysql_connect("localhost","root","");
$itemName=$_GET['itemname'];
$category=$_GET['category'];
$cost=$_GET['cost'];
$contact=$_GET['contact'];
$uid=$_GET['uid'];
$db=mysql_select_db("sec_hand");

$result=mysql_query("insert into buy (name,category,expected_cost,contact,uid) values('$itemName','$category','$cost','$contact','$uid')") or die(mysql_error());

if(isset($result)&&isset($conn))
{
	echo "Item successfully added! ";
	?>

	<a href="index.php">Back</a>
	<?php 
}
else
{
	echo "Some error";
}
?>