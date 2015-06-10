<?php  
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("sec_hand");
$category=$_GET['category'];
if($category=="all"){
	$sql="select * from sell where sold=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$id."<br>";
		echo "Name: ".$row['name']."<br>";
		echo "Category: ".$row['category']."<br>";
		echo "Description: ".$row['description']."<br>";
		echo "Cost: ".$row['cost']."<br>";
		echo "Contact Number: ".$row['contact']."<br>";
		echo "<hr>";
		$id++;
	}

}
else {
$sql="select * from sell where sold=0 and category='{$category}'";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$id."<br>";
		echo "Name: ".$row['name']."<br>";
		echo "Category: ".$row['category']."<br>";
		echo "Description: ".$row['description']."<br>";
		echo "Cost: ".$row['cost']."<br>";
		echo "Contact Number: ".$row['contact']."<br>";
		echo "<hr>";
		$id++;
	}
}

?>