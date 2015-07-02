
<script>
$(document).ready(function() {
	$('select').material_select();
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15 // Creates a dropdown of 15 years to control year
	});
});

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
	<h5 class="header light center">Fill in</h5>
<div class="row card-panel">
<form name ="buyForm" onsubmit="return validateForm()" action = "buy_items.php" method="GET" class="col s12">
	<div class="row">
		<div class="input-field col s12 m12"><label>Item Name</label>
	<input name="itemname" type="text">
</div></div>
	<div class="row">
		<div class="input-field col s12 m12">

			<select name="category">
		<option name="category" value="Electrical">Electrical</option>
		<option name="category" value="Household">Household</option>
		<option name="category" value="Category 3">Category 3</option>
		<option name="category" value="Category 4">Category 4</option>
		<option name="category" value="Category 5">Category 5</option>
	</select>
</div>
</div>
<div class="row">
	<div class="input-field col s12 m6">
	<label>Expected Cost</label>
		<input name="cost" type="text">
</div>
<div class="input-field col s12 m6">
	<label>Contact</label><input name="contact" type="text">
</div>
</div>
  <input type="hidden" name="uid" value="<?php echo $uid; ?>">
	<button class="btn waves-effect waves-light red right" type="submit" name="action">Post
	</button>
	</form>
</div>
