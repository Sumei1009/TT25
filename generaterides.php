<?php 
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    header("Location: ./signin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Generate Rides</title>
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
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="activerides.php">Active Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="currentbids.php">Current Bids</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="generaterides.php">Generate Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="searchrides.php">Search Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="searchrides.php">Search Rides</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="carprofile.php">Car Information</a>          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Logout</a>
        </li>
      </ul>
    </div>
    </nav>

	<span class="d-block p-2 bg-primary text-white">Generate a new ride!</span>


	<div class="container">
  <?php
    $db = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");
    $result = pg_query($db, "SELECT * FROM car WHERE phone_number = $user_id ");
    $row = pg_fetch_assoc($result);

    if (!$row){
      echo "You need to register a car first\n";
      echo "<button onclick=\"location.href='regiscar.php'\">Register</button>";
    }else{
      echo "
      <form name=\"display\" class=\"bd-example\" method=\"POST\">
        <fieldset>
          <legend > Please fill in your ride information</legend>
          <p>
            <label class=\"carlabel\" for=\"input\">Origin:</label>
            <input type=\"text\" name=\"origin\" /></li>
          </p>
          <p>
            <label class=\"carlabel\" for=\"input\">Destination:</label>
            <input type=\"text\" name=\"destination\" /></li>
          </p>
          <p>
            <label class=\"carlabel\" for=\"input\">Number of Seat:</label>
            <input type=\"text\" name=\"seat\" /></li>     
          </p>
          <p>
            <label class=\"carlabel\" for=\"input\">Date of ride:</label>
            <input type=\"text\" name=\"date\" /></li>
          </p>
          <p>
            <label class=\"carlabel\" for=\"input\">Time of ride:</label>
            <input type=\"text\" name=\"time\" /></li>
          </p>

          <p>
            <input type=\"submit\" name=\"submit\" /> 
          </p>
        </fieldset>
      </form>
        ";
    }

   ?>

		
		

	</div>




	<?php 

  function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }

  $rid_number = generateRandomString();
  $zerovalue = 0;
  $currentdate = date("Y-m-d");

  echo  $currentdate;

	$db = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");

	if (isset($_POST['submit'])) {
        echo $_POST[time];
        echo $_POST[seat];
        echo $_POST[date];
        echo $_POST[origin];
        echo $_POST[destination];
        $result = pg_query($db, "INSERT INTO ride_generate VALUES('$rid_number', '$user_id', null,   '$currentdate', '$_POST[date]' , '$_POST[time]', '$_POST[seat]' , '$_POST[origin]' , '$_POST[destination]' , 0  )" );
        if (!$result) {
            echo "Update failed!!";
        } else {
            echo "Update successful!";
        }
    }

	?>

</body>
</html>
