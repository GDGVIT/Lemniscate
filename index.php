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

</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></SCRIPT>

<body class="bg-login">
	<div class="login-screen">
		<div class="panel-login blur-content">
			<h3 class="white-text" align="center">Lemniscate</h3>

			<div id="pane-login" class="panel-body active">
				<div><h2>Login to Dashboard</h2></div>
				<div class="">
                  <form class="col s12" action='<?php echo $_SERVER["PHP_SELF"];?>'  method="POST">
                    <div class="row">
                      <div class="input-field col s12">
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
                     <div class="col s12" style="margin-top:50px;" align="center">
                     	<button class="btn waves-effect waves-light #03a9f4 light-blue" type="submit" name="action">Submit
                          <i class="mdi-content-send right"></i>
                        </button>
                     </div>
                    </div>
                  </form>
                </div>
			</div><!--#login.panel-body-->

			<div id="pane-create-account" class="panel-body">
				<h2>Create a New Account</h2>
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<input type="text" class="form-control" placeholder="Enter your full name">
						</div>
					</div>
				</div><!--.form-group-->
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<input type="email" class="form-control" placeholder="Enter your email address">
						</div>
					</div>
				</div><!--.form-group-->
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<input type="password" class="form-control" placeholder="Enter your password">
						</div>
					</div>
				</div><!--.form-group-->
				<div class="form-group">
					<div class="inputer">
						<div class="input-wrapper">
							<input type="password" class="form-control" placeholder="Enter your password again">
						</div>
					</div>
				</div><!--.form-group-->
				<div class="form-group">
					<label><input type="checkbox" name="remember" value="1"> I have read and agree to the term of use.</label>
				</div>
				<div class="form-buttons clearfix">
					<button type="submit" class="btn btn-white pull-left show-pane-login">Cancel</button>
					<button type="submit" class="btn btn-success pull-right">Sign Up</button>
				</div><!--.form-buttons-->
			</div><!--#login.panel-body-->

		</div><!--.blur-content-->
	</div><!--.login-screen-->

	<div class="bg-blur dark">
		<div class="overlay"></div><!--.overlay-->
	</div><!--.bg-blur-->


</body>
</html>