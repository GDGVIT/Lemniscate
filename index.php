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
				<div><div class="row">
                  <div class="col s12">
                    <ul class="tabs">
                      <li class="tab col s3"><a href="#tab1">Login</a></li>
                      <li class="tab col s3"><a href="#tab2">New User</a></li>
                    </ul>
                  </div>
                  <div id="tab1" class="col s12">
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
                                   <div class="col s12 hcenter">
                                   	<a class="waves-effect waves-light btn-flat white-text">Forgot Password</a>
                                   </div></div>
                                </form>
                  </div>

                  <div id="tab2" class="col s12">
                                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                                  <div class="row">
                                    <div class="input-field col s12" style="margin-top:30px;">
                                      <input id="regno_id" type="text" class="validate white-text">
                                      <label for="regno_id">Registration Number</label>
                                    </div>
                                   <div class="input-field col s12">
                                      <input id="email_id" type="email" class="validate white-text">
                                      <label for="email_id">Email-ID</label>
                                    </div>
                                    <div class="input-field col s12">
                                    <label for="birthdate">Birthdate</label>
                                    <input id="birthdate" type="text" class="datepicker white-text">
                                    </div>
                                    <div class="col s12" style="margin:40px 0 10px 0; text-align:center;">
                                   	   <button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Register
                                        <i class="mdi-content-send right"></i>
                                      </button>
                                   </div></div>
                                </form>
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
                
</body>
</html>