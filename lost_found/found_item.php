<?php
include_once('connection.php');
	$u_id='4';
$item_name=$_GET['title'];
$location=$_GET['location'];
$description = $_GET['description'];
$date = $_GET['date_on'];
$color = $_GET['color'];
$contact = $_GET['contact'];
$handed_over = $_GET['handed_over'];
$category=$_GET['category'];

$result=mysql_query("insert into found (user_id,name,location,item_desc,handed_over,date_on,colour,contact,category) values('$u_id','$item_name','$location','$description','$handed_over','$date','$color','$contact','$category')") or die(mysql_error());

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
