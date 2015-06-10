<html>
<head>
</head>
<body>

<script type="text/javascript">
function a()
{
	alert("Hello");
}
function validateForm() {
	if( document.sellForm.itemname.value == "" )
   {
     alert( "Please provide your name!" );
     document.sellForm.itemname.focus() ;
     return false;
   }
   // if( document.sellForm.description.value == "" )
   // {
   //   alert( "Please provide your Email!" );
   //   document.sellForm.description.focus() ;
   //   return false;
   // }
   if( document.sellForm.cost.value == "" ||
           isNaN( document.sellForm.cost.value )
   {
     alert( "Please provide a valid cost" );
     document.sellForm.cost.focus() ;
     return false;
   }
   if(document.sellForm.contact.length!=10 && 
   	isNaN(document.sellForm.contact.value))
   {
   	alert("Please enter a valid Contact number. Make sure you dont enter country code before contact number!");
   }
   return (true);
}
</script>	
<?php
$uid=4;
?>
	<h1>Sell</h1>
	<h2>Please fill out the following things</h2>
 
<form name ="sellForm" onsubmit="return validateForm()" action = "sell_items.php" method="GET"  >
	Item Name<input name="itemname" type="text"><br>
	Category<select name="category">
		<option type = "radio"  value="Electrical">Electrical</option><br>
		<option type = "radio"  value="Household">Household</option><br>
		<option type = "radio"  value="Category 3">Category 3</option><br>
		<option type = "radio"  value="Category 4">Category 4</option><br>
		<option type = "radio"  value="Category 5">Category 5</option><br>
	</select>	
	<br>Descriptcion<input name="description" type="text"><br>
	Cost<input name="cost" type="text"><br>
	Contact<input name="contact" type="text"><br>
  <input type="hidden" name="uid" value="<?php echo $uid; ?>">
	<input type="submit" value="Submit">
	</form>
</body>
</html>