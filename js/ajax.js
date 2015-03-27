 function register_new_user()//(index.php , )
{
	alert("hi");
	var regno = document.getElementById("regno_id").value;
	var dob = document.getElementById("dob").value;
	var email = document.getElementById("email_id").value;
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
  	{
    	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
			alert(JSON.parse(xmlhttp.responseText));
      		
    	}
  	}
 xmlhttp.open("POST","https://vitacademics-rel.herokuapp.com/api/v2/vellore/login",true);
 xmlhttp.setRequestHeader('Content-Type', 'application/json');
 xmlhttp.send("regno=12mse0363&dob=01101994");
}