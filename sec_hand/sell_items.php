<?php  
$conn=mysqli_connect("localhost","root","");
$itemName=$_GET['itemname'];
$category=$_GET['category'];
$description=$_GET['description'];
$cost=$_GET['cost'];
$contact=$_GET['contact'];
$uid=$_GET['uid'];
$db=mysqli_select_db($conn,"db");

$result=mysqli_query($conn,"insert into sell (name,category,cost,description,contact,uid) values('$itemName','$category','$cost','$description','$contact','$uid')") or die(mysql_error());

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