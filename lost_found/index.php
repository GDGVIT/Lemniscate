<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/materialize.min.css">

  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified JavaScript -->
  <script src="js/jquery-2.1.3.min.js">
  </script>
  <script>
  $(document).ready(function() {
    $('select').material_select();
  });
  $('#show_category').form({
    success:function(data){
      $.messager.alert('Info', data, 'info');
    }
  });
  </script>
  <script src="js/materialize.min.js"></script>
  <title>Lost and Found</title>
</head>
<!---
Just a home page with a list of lost and found related queries....
-->
<body>
  <!-- <nav>  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle hide-on-large-only"><i class="mdi-navigation-menu"></i></a></div>
  <ul id="nav-mobile" class="side-nav fixed">
  <li class="bold"><a href="lost.php">Add Lost Item</a></li>
  <li class="bold"><a href="found.php">Add found item</a></li>
  <li class="bold"><a href="all_found_items.php">Show all found items</a></li>
  <li class="bold"><a href="all_lost_items.php">Show all lost items</a></li>
  <li class="bold"><a href="my_found_items.php">Items I found</a></li>
  <li class="bold"><a href="my_lost_items.php">Items I lost</a></li>

</ul>
</nav> !-->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large tooltipped" data-position="left" data-delay="50" data-tooltip="Add Lost and Found" style="background-color:#3E50B4">
    <i class="large material-icons">add</i>
  </a>
  <ul>
    <li><a class="btn-floating red tooltipped" data-position="left" data-delay="50" data-tooltip="Add Lost Item" href="lost.php"><i class="material-icons">info_outline</i></i></a></li>
    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Add Found Item" href="found.php"><i class="material-icons">search</i></a></li>
  </ul>
</div>
<div id='display' align='center'><div class='stitle light'>Lemniscate | Lost and Found</div></div>
<div class="container row">
  <div class="col s12 m12">
    <ul class="tabs">
      <li class="tab col s6 m6"><a class="<?php if(!isset($_POST['lost'])){ echo 'active';}?>" href="#all_f">All Found</a></li>
      <li class="tab col s6 m6"><a <?php if(isset($_POST['lost'])){ echo 'class="active"';}?> href="#all_l">All Lost</a></li>
      <li class="tab col s6 m6"><a href="#my_l">Lost by Me</a></li>
      <li class="tab col s6 m6"><a href="#my_f">Found by Me</a></li>
    </ul>
  </div>
  <div id="all_f" class="col s12 m12">
    <form id="show_category" method="POST" action="">
      <div class="input-field col s6"><select name="location">
        <option value="all">All locations</option><br>
        <option value="Mens Hostel">Men's Hostel</option><br>
        <option value="SJT">SJT</option><br>
        <option value="TT">TT</option><br>
        <option value="MB">MB</option><br>
        <!--More options can be added here -->
      </select>
    </div>
    <button class="btn waves-effect waves-light" style="margin-top:3%;background-color:#3E50B4" type="submit" name="found">Submit
      <i class="material-icons">send</i>
    </button>
  </form>
  <ul class="collection col s12">
    <?php
    include_once('show_found_items_by_location.php');
    ?>
  </ul>
</div>
<div id="all_l" class="col s12 m12">
  <form id="show_category" method="POST" action="">
    <div class="input-field col s6"><select name="location">
      <option value="all">All locations</option><br>
      <option value="Mens Hostel">Men's Hostel</option><br>
      <option value="SJT">SJT</option><br>
      <option value="TT">TT</option><br>
      <option value="MB">MB</option><br>
      <!--More options can be added here -->
    </select>
  </div>
  <button class="btn waves-effect waves-light" style="margin-top:3%;background-color:#3E50B4" type="submit" name="lost">Submit
    <i class="material-icons">send</i>
  </button>
</form>
<ul class="collection col s12">
  <?php
  include_once('show_items_by_location.php');
  ?>
</ul>
</div>
<div id="my_l" class="col s12 m12">
  <ul class="collection col s12">
    <?php
    include_once('my_lost_items.php');
    ?>
  </ul>
</div>
<div id="my_f" class="col s12 m12">
  <ul class="collection col s12">
    <?php
    include_once('my_found_items.php');
    ?>
  </ul>
</div>
</div>

</body>
</html>
