<html>
<body>
<h1>Buy</h1>
	<h2>Please fill out the following things</h2>
 <?php 
$uid=4;
 ?>
<form name ="buyForm" onsubmit="return validateForm()" action = "buy_items.php" method="GET"  >
	Item Name<input name="itemname" type="text"><br>
	Category<select name="category">
		<option type = "radio"  value="Electrical">Electrical</option><br>
		<option type = "radio"  value="Household">Household</option><br>
		<option type = "radio"  value="Category 3">Category 3</option><br>
		<option type = "radio"  value="Category 4">Category 4</option><br>
		<option type = "radio"  value="Category 5">Category 5</option><br>
	</select><br>	
	Expected Cost<input name="cost" type="text"><br>
	Contact<input name="contact" type="text"><br>
  	<input type="hidden" name="uid" value="<?php echo $uid; ?>">
	<input type="submit" value="Submit">
	</form>
</body>
</html>