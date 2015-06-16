<html>
<body>

<form id="show_category" method="GET" action="show_items.php">
Category<select name="category" onchange='this.form.submit()'>
		<option type="radio" value = "" selected>Select Category</option>
		<option type="radio" value="all">Show All</option>
		<option type = "radio"  value="Electrical">Electrical</option><br>
		<option type = "radio"  value="Household">Household</option><br>
		<option type = "radio"  value="Category 3">Category 3</option><br>
		<option type = "radio"  value="Category 4">Category 4</option><br>
		<option type = "radio"  value="Category 5">Category 5</option><br>
	</select>
	<noscript><input type="submit" value="Submit"></noscript>
</form>

	<?php
		if(isset($_GET['category'])){
			$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("db");
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

		}
	?>
<script type="text/javascript">
$('#show_category').form({
    success:function(data){
        $.messager.alert('Info', data, 'info');
    }
});
</script>
</body>
</html>
