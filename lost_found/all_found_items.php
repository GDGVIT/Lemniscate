<html>
<!-- This page asks for the location wise found items... User can select all locations to get a list of all found items that are yet in the found list-->
<body>
<form id="show_category" method="GET" action="show_found_items_by_location.php">
<label>Location</label><select name="location">
		<option value="all">All locations</option><br>		
		<option value="Mens Hostel">Men's Hostel</option><br>
		<option value="SJT">SJT</option><br>
		<option value="TT">TT</option><br>
		<option value="MB">MB</option><br>
	<!--More options can be added here -->
	</select><br>	

<input type = "submit" value="Search by location">	
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
