<?php
// Start the session
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    header("Location: ./signin.php");
    exit;
}
?>
<!DOCTYPE html>  
<head>
  <title>Index</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" crossorigin="anonymous">
  <link rel="stylesheet" href="bootstrap/css/style.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm sticky-top bg-warning navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="myprofile.php">My Profile</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="viewmyrides.php">My Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="currentbids.php">Current Bids</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="generaterides.php">Generate Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="searchride.php">Search Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="carprofile.php">Car Profile</a>          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Logout</a>
        </li>
      </ul>
    </div>
    </nav>
  <span class="d-block p-2 bg-primary text-white">Update Car</span>
<div class="container">
    <form name="display" class="bd-example" method="POST">
    <fieldset>
      <legend > Update Car</legend>
      <p>
        <label class="carlabel" for="input">Car Id:</label>
        <input type="text" name="car_id" /></li>
      </p>
      <p>
        <label class="carlabel" for="input">Car Brand:</label>
        <input type="text" name="car_brand" /></li>
      </p>
      <p>
        <label class="carlabel" for="input">Car Model:</label>
        <input type="text" name="car_model" /></li>
      </p>
      <p>
        <input class='btn btn-outline-primary' style='margin-right: 100px;' type="submit" name="submit" /> 
        <input class='btn btn-outline-primary' onclick="location.href='carprofile.php'" type="button" name="cancel" value="Cancel"/>
      </p>
    </fieldset>

  </form>
<?php
	if($_POST['car_id']&&$_POST['car_brand']&&$_POST['car_model']){
		// Connect to the database. Please change the password in the following line accordingly
	    $db  = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");	
		$result = pg_query($db, "UPDATE car SET car_id='$_POST[car_id]',car_model='$_POST[car_model]',car_brand='$_POST[car_brand]' WHERE phone_number='$user_id'");
		if (isset($_POST['submit'])){
				if ($result){
					echo "Update successful";
					}
				else{
					echo "Update failed";
				}
			}
		}
		else{
			if (isset($_POST['submit'])){
				echo "Incomplete Information";
			}

		}
?>
</div>
</body>
</html>
