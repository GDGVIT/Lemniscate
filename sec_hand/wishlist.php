<html>
<body>
<form id="show_category" method="GET" action="show_wishlist.php">
Category<select name="category">
		<option type="radio" value="all">Show All</option>
		<option type = "radio"  value="Electrical">Electrical</option><br>
		<option type = "radio"  value="Household">Household</option><br>
		<option type = "radio"  value="Category 3">Category 3</option><br>
		<option type = "radio"  value="Category 4">Category 4</option><br>
		<option type = "radio"  value="Category 5">Category 5</option><br>
	</select>
<input type = "submit" value="Search category">	
</form>
<script type="text/javascript">
$('#show_category').form({
    success:function(data){
        $.messager.alert('Info', data, 'info');
    }
});
</script>
</body>
</html>
