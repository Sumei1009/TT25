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
  <title>Search rides</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
  <style>p.indent{ padding-left: 1.0 em }</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
	          <a class="nav-link active" href="searchride.php">Search Rides</a>
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
	  <div class="container">
  <h2>Search ride</h2>
   <ul>
    <form name="display" action="searchride.php" method="POST" >
	<li><label style="padding-right: 10px;">Date</label><input placeholder="date" type="date" name="date" />       <input placeholder="origin" type="text" name="origin" />    
	<input type="text" placeholder="destination" name="destination" />  <input class="btn btn-outline-primary" type="submit" name="submit" value="search"></li>
	</form>
   </ul>

   <span class="d-block p-2 bg-primary text-white">Results</span>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");	
	if (!($_POST['destination'])&&!($_POST['origin'])&&!($_POST['date'])){
		$result=pg_query($db, "SELECT distinct date_of_ride,time_of_ride,origin,destination,car_brand,car_model,K.rid_number rid_number,K.rider_id rider_id,(SELECT count(*) FROM bid WHERE bid.rid_number=K.rid_number) num_bidders, (SELECT max(point) FROM bid WHERE bid.rid_number=K.rid_number) max_bid, (SELECT point FROM bid WHERE bid.rid_number=K.rid_number AND bid.phone_number='$user_id') point
		FROM (ride_generate R INNER JOIN car C ON (R.rider_id=C.phone_number)) K LEFT OUTER JOIN bid B ON K.rid_number=B.rid_number
		ORDER BY date_of_ride, time_of_ride;");
		}
	elseif (!(($_POST['destination'])&&($_POST['origin'])&&($_POST['date']))){
		//do nothing
		}
	else{
		$result = pg_query($db, "SELECT distinct date_of_ride,time_of_ride,origin,destination,car_brand,car_model,K.rid_number rid_number,K.rider_id rider_id,(SELECT count(*) FROM bid WHERE bid.rid_number=K.rid_number) num_bidders, (SELECT max(point) FROM bid WHERE bid.rid_number=K.rid_number) max_bid, (SELECT point FROM bid WHERE bid.rid_number=K.rid_number AND bid.phone_number='$user_id') point
		FROM  (ride_generate R INNER JOIN car C ON (R.rider_id=C.phone_number)) K LEFT OUTER JOIN bid B ON K.rid_number=B.rid_number
		WHERE date_of_ride='$_POST[date]' AND origin='$_POST[origin]' AND destination='$_POST[destination]'
		ORDER BY date_of_ride, time_of_ride");
		}
	if (isset($_POST['submit'])) {
		if (!$result&&!(($_POST['destination'])&&($_POST['origin'])&&($_POST['date']))){
			echo 'incomplete information';
			}
		elseif (!$result){
			echo 'Ops! It is empty';
		}
		else {
			echo "<table class='table'><thead><tr>
			<th scope='col'>Date of Ride</th>
			<th scope='col'>Time of Ride</th>
			<th scope='col'>Origin</th>
			<th scope='col'>Destination</th>
			<th scope='col'>Car Brand</th>
			<th scope='col'>Car Model</th>
			<th scope='col'>Number of Bidders</th>
			<th scope='col'>Your Bid</th>
			<th scope='col'>Highest Bid</th>
			</tr></thead><tbody>";
			while ($row=pg_fetch_assoc($result)){
				echo "<tr><td>" .$row["date_of_ride"]. "</td><td>" .$row["time_of_ride"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]. "</td><td>"  .$row["car_brand"]. "</td><td>"  .$row["car_model"].  "</td><td>"  .$row["num_bidders"].  "</td><td>"  .$row["point"].  "</td><td>"  .$row["max_bid"].
				"</td><td>
				<form name='".$row[rid_number]."' method=\"POST\" >
				<div class='row'>
				<div class='col-7'><input style='width:90px;' type=\"text\" name=\"new_bid\" /></div>
				<div class='col-3'><input class='btn btn-outline-primary' style='padding-bottom: 0; padding-top: 0;' type=\"submit\" name='bid' value=\"Bid\"></div>
				</div>
				<input type=\"hidden\" name=\"rid_number\" value='".$row[rid_number]."'/>
				<input type=\"hidden\" name=\"rider_id\" value='".$row[rider_id]."'/>
				</form>
				</td></tr>";
			}
			echo "</tbody></table>";
		}
	}
	if (isset($_POST['bid'])) {
		$new_bid = $_POST['new_bid'];
		$rid = $_POST['rid_number'];
		$did = $_POST['rider_id'];
		$result2 = pg_query($db, "INSERT INTO bid VALUES ({$user_id}, '{$rid}', {$did}, null, {$new_bid});"); 
		if (!$result2) {
			$result1 = pg_query($db, "UPDATE bid SET point = '{$new_bid}'
	          WHERE rid_number = '{$rid}'
	          AND phone_number ='{$user_id}';"); 
			if (!$result1) {
				echo "Update bid fails!!";
			} else {
				echo "<meta http-equiv='refresh' content='0'>";
			}
		} else {
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}
    ?>  
</div>

</body>
</html>
