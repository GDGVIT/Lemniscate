<?php  
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("sec_hand");
$category=$_GET['category'];
if($category=="all"){
	$sql="select * from buy where status=0";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$id."<br>";
		echo "Name: ".$row['name']."<br>";
		echo "Category: ".$row['category']."<br>";
		echo "Expected Cost: ".$row['expected_cost']."<br>";
		echo "Contact Number: ".$row['contact']."<br>";
		echo "<hr>";
		$id++;
	}

}
else {
$sql="select * from buy where status=0 and category='{$category}'";
$id=1;
$result=mysql_query($sql,$conn) or die(mysql_error());
	while ($row=mysql_fetch_array($result)) {

		echo "ID: ".$id."<br>";
		echo "Name: ".$row['name']."<br>";
		echo "Category: ".$row['category']."<br>";
		echo "Cost: ".$row['expected_cost']."<br>";
		echo "Contact Number: ".$row['contact']."<br>";
		echo "<hr>";
		$id++;
	}
	if($id=1)
		echo "No items matched your preference";
}

?>