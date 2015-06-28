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
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
    });
  });


  </script>
  <title>Add Lost</title>
  <script src="js/materialize.min.js"></script>
</head>

<div id='display'><div class='stitle light' align='center'>Lemniscate | Lost and Found</div></div>
<h3 class="header light center">Add Lost Item</h3>
<h5 class="header light center">Please enter the details below of the item that you have lost:</h5>
<div class="container row">
  <form action = "lost_item.php" class="col s12" method = "GET">
    <div class="row">
      <div class="input-field col s12 m6"><label>Name</label><input type ="text" name = "title"></div>
      <div class="input-field col s12 m6"><select name="location">
        <option value="Mens Hostel">Men's Hostel</option>
        <option value="SJT">SJT</option>
        <option value="TT">TT</option>
        <option value="MB">MB</option>
        <!--More options can be added here -->
      </select></div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <textarea class="materialize-textarea" name ='description'></textarea><label>Description</label></div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6"><label>Contact</label>
          <input type = "text" name ='contact'></div>
          <div class="input-field col s12 m6"><label>Date</label><input type ="date" name = "date_on" class="datepicker"></div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6"><select name="category">
            <option value="Electronics">Electronics</option>
            <option value="I-CARD">I-CARD</option>
            <option value="Notebooks or Books">Notebooks or Books</option>
            <option value="Wallet">Wallet</option>
            <!--More options can be added here -->
          </select></div>
          <div class="input-field col s12 m6"><label>Color</label><input type ="text" name = "color"></div>
        </div>
        <button class="btn waves-effect waves-light red right" type="submit" name="action">Submit
          <i class="material-icons">send</i>
        </button>
      </form>
    </div>
    </html>
