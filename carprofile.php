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
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">My Profile</a>
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
          <a class="nav-link" href="carprofile.php">Car Information</a>          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Logout</a>
        </li>
      </ul>
    </div>
    </nav>



	<span class="d-block p-2 bg-primary text-white">Car Profile</span>



	<?php 
	$db = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=Ml271slwmx");

	$result = pg_query($db, "SELECT car_id, car_brand, car_model FROM car WHERE phone_number = $user_id  ");

	$row = pg_fetch_assoc($result);

	if (!$row){
		echo "You haven't registered a car yet! \n";
		echo "<button onclick=\"location.href='regiscar.php'\">Register a car</button>";

	}else{
    echo "<div class=\"container\">  <p> This is your car infromation: </p> </div>";
    echo "<table class='table'><thead><tr>
      <th scope='col'>Car Id</th>
      <th scope='col'>Brand</th>
      <th scope='col'>Model</th>
      </tr></thead><tbody>";
		echo "<tr><td>".$row["car_id"]. "</td>";
		echo "<td>".$row["car_brand"]."</td>";
		echo "<td>".$row["car_model"]."</td></tr>";
    echo "</tbody></table>";
    echo "<form action='updatecar.php'><input type='submit' value='Update Information' /></form>";
	}

?>







	




</body>
</html>
