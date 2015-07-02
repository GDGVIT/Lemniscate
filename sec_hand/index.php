<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="js/jquery-2.1.3.min.js"></script>

  <script src="js/materialize.min.js"></script>
  <title>Buy and Sell</title>
</head>
<body>
<div id='display' align='center'><div class='stitle light'>Buy and Sell</div></div>
	<!--<h1>Buy And Sell</h1>
	<ul>
	<li><a href="sell.php">Sell</a><br></li>
	<li><a href="buy.php">Buy</a><br></li>
	<li><a href="show_items.php">Show items</a></li>
	<li><a href="my_items.php">My Items</a></li>
</ul> !-->
<br>
<div class="container row">
	<div class="col s12 m12">
    <ul class="tabs">
      <li class="tab col s6 m6"><a href="#sell">Sell</a></li>
      <li class="tab col s6 m6"><a href="#buy">Buy</a></li>
      <li class="tab col s6 m6"><a <?php
				if(isset($_POST['category'])){
					echo 'class="active"';
				}
				?>href="#show_i">Show items</a></li>
      <li class="tab col s6 m6"><a href="#my_i">My items</a></li>
    </ul>
  </div>
  <br><br><br><br>
	<div id="sell" class="col s12 m12"><?php include_once('sell.php'); ?></div>
	<div id="buy" class="col s12 m12"><?php include_once('buy.php'); ?></div>
	<div id="show_i" class="col s12 m12"><?php include_once('show_items.php'); ?></div>
	<div id="my_i" class="col s12 m12"><?php include_once('my_items.php'); ?></div>
</div>
</body>
</html>
