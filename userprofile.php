<!DOCTYPE html>
<head>
	<title>User Profile</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>li {list-style: none;}</style>
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
            <a class="nav-link active" href="myprofile.php">My Profile</a>
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
          <a class="nav-link" href="carprofile.php">Car Profile</a>          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Logout</a>
        </li>
      </ul>
    </div>
    </nav>
	<h2>User profile</h2>



	<?php 
	$db = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");

	$result = pg_query($db, "SELECT car_id, car_brand, car_model FROM car WHERE phone_number = '9038899211'  ");

	$row = pg_fetch_assoc($result);

	if (!$result){
		echo "You haven't registered a car yet! \n";
		echo("<button onclick=\"location.href='regiscar.php'\">Register a car</button>");

	}else{
		echo $row["car_id"];
		echo $row["car_brand"]; 
		echo $row["car_model"];
	}
	?>
</body>
</html>