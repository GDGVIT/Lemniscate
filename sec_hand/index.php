<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
