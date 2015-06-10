<?php
	$conn=mysql_connect("localhost","root","");
	if(isset($item_name)&&isset($location)&&isset($description)){
$u_id='4';
$item_name=$_GET['title'];
$location=$_GET['category'];
$description = $_GET['description'];
$date = $_GET['date_on'];
$color = $_GET['color'];
$contact = $_GET['contact'];
$handed_over = $_GET['handed_over'];

$db=mysql_select_db("lemniscate");

$result=mysql_query("insert into found (user_id,name,location,item_desc,handed_over,date_on,colour,contact) values('$u_id','$item_name','$location','$description','$handed_over','$date','$color','$contact')") or die(mysql_error());

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
}
else echo " please enter all the details! <a href = 'lost.php'>Back</a>!" ;

?>