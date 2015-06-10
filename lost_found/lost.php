
<html>
<h1>Lost</h1>
<h3>Please enter the details below of the item that you have lost:</h3>
<form action = "my_lost_item.php" method = "GET">
<label>Name of the Item</label>&nbsp;&nbsp;&nbsp;<input type = "text" name = "title"><br>
<label>Location</label><select name="category">
		<option value="Mens Hostel">Men's Hostel</option><br>
		<option value="SJT">SJT</option><br>
		<option value="TT">TT</option><br>
		<option value="MB">MB</option><br>
	<!--More options can be added here -->
	</select><br>	
	<label>Description</label>&nbsp;&nbsp;&nbsp;
<input type = "text" name ='description'>
<br>

	<label>Contact</label>&nbsp;&nbsp;&nbsp;
<input type = "text" name ='contact'>
<label>Date</label><input type ="date" name = "date_on"><br>
<label>Color</label><input type ="text" name = "color"><br>
	<input type = "submit" value="Add Record">	
</form>
</html>