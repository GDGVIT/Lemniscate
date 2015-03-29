<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

	<title>Lemniscate | Login</title>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/materialize.css">


    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></SCRIPT>

</head>

<body class="bg-login">
	<div class="login-screen">
		<div class="panel-login blur-content">
			<h3 class="white-text hcenter" style="padding-top:10px;">Lemniscate</h3>

			<div id="pane-login" class="panel-body active">
				<div class="row">
                  <div class="col s12 tabln">
                    <ul class="tabs">
                      <li class="tab col s3"><a href="#tab1" class="active" onclick="hide1tab3();">Login</a></li>
                      <li class="tab col s3"><a href="#tab2" onclick="hide2tab3();">New User</a></li>
                    </ul>
                  </div>
                  <div id="tab1" class="col s12 tab1">
                                 <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="uname_id" type="text" class="validate white-text">
                                      <label for="uname_id">Username</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input id="pword_id" type="password" class="validate white-text">
                                      <label for="pword_id">Password</label>
                                    </div>
                                   <div class="remcheck col s12">
                                   	<input type="checkbox" id="save_login" />
                                      <label for="save_login">Remember Me</label>
                                   </div>
                                   <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	<button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Submit
                                        <i class="mdi-content-send right"></i>
                                      </button>
                                   </div>
                                 </div>
                                </form>
                  </div>

                  <div id="tab2" class="col s12 tab2">
                                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_id" type="text" class="validate white-text">
                                      <label for="regno_id">Registration Number</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input id="pwd" type="password" class="validate white-text">
                                      <label for="pwd">Password</label>
                                    </div>
                                   <div class="input-field col s12">
                                      <input id="email_id" type="email" class="validate white-text">
                                      <label for="email_id">Email ID</label>
                                    </div>
                                    <div class="input-field col s12">
                                    <label for="birthdate">Birthdate</label>
                                    <input id="birthdate" type="text" class="datepicker white-text">
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	   <button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Register
                                        <i class="mdi-social-person-add right"></i>
                                      </button>
                                   </div></div>
                                </form>
                  </div>
                  <div class="col s12" id="fwpd" style="text-align:center;">
                  <a class="waves-effect waves-light btn-flat tab3 white-text" onclick="showtab3();">Forgot Password</a>
                  </div>
                  <div id="tab3" class="col s12 tab3c">
                                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_id" type="email" class="validate white-text">
                                      <label for="regno_id">Email ID</label>
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                       <button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Get Password
                                        <i class="mdi-action-get-app right"></i>
                                      </button>
                                   </div></div>
                                </form>
                                <div class="col s12" style="text-align:center;">
                                <a class="waves-effect waves-light btn-flat white-text" onclick="showtab1();">Login</a>
                                </div>
                  </div>

                </div>
                </div>
			</div></div>

	<div class="bg-blur dark">
		<div class="overlay"></div><!--.overlay-->
	</div><!--.bg-blur-->

<script type="text/javascript"> $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 50 // Creates a dropdown of 15 years to control year
  });</script>
<script type="text/javascript">
function showtab1(){
      $("#tab1").show();
      $(".tabln").show();
      $("#tab3").hide();
     }
function hide1tab3(){
      $("#tab3").hide();
      $("#fwpd").show();
     }
function hide2tab3(){
      $("#tab3").hide();
      $("#fwpd").hide();
     }
function showtab3(){
      $("#tab3").show();
     }
  $(document).ready(function(){ 
     $(".tab3c").hide();
     $(".tab3").click(function(){
        $(".tab1").hide("slow");
        $(".tabln").hide();

     });
   
});
</script>
                
</body>
</html>