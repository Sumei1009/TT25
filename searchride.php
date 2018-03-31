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
  <title>Search ride</title>
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
  <h2>Search ride</h2>
   <ul>
    <form name="display" action="searchride.php" method="POST" >
	<li> Date: Origin:  Destination: </li>
	<li><input type="date" name="date" />       <input type="text" name="origin" />    
	<input type="text" name="destination" />  <input type="submit" name="submit" value="search"></li>
	</form>
   </ul>

   <span class="d-block p-2 bg-primary text-white">Results</span>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=project1 user=wthanw password=qchenxm");	
	if (!($_POST['destination'])&&!($_POST['origin'])&&!($_POST['date'])){
		$result=pg_query($db, "SELECT date_of_ride,time_of_ride,origin,destination,car_brand,car_model,K.rid_number Y,K.rider_id U,(SELECT count(*) FROM bid WHERE bid.rid_number=K.rid_number) num_bidders, (SELECT max(point) FROM bid WHERE bid.rid_number=K.rid_number) max_bid, (SELECT point FROM bid WHERE bid.rid_number=K.rid_number AND bid.phone_number='$user_id') point
		FROM (ride_generate R INNER JOIN car C ON (R.rider_id=C.phone_number)) K LEFT OUTER JOIN bid B ON K.rid_number=B.rid_number
		GROUP BY date_of_ride,time_of_ride,origin,destination,car_brand,car_model,K.rid_number");
		}
	elseif (!(($_POST['destination'])&&($_POST['origin'])&&($_POST['date']))){
		//do nothing
		}
	else{
		$result = pg_query($db, "SELECT date_of_ride,time_of_ride,origin,destination,car_brand,car_model,K.rid_number Y,K.rider_id U,(SELECT count(*) FROM bid WHERE bid.rid_number=K.rid_number) num_bidders, (SELECT max(point) FROM bid WHERE bid.rid_number=K.rid_number) max_bid, (SELECT point FROM bid WHERE bid.rid_number=K.rid_number AND bid.phone_number='$user_id') point
		FROM  (ride_generate R INNER JOIN car C ON (R.rider_id=C.phone_number)) K LEFT OUTER JOIN bid B ON K.rid_number=B.rid_number
		WHERE date_of_ride='$_POST[date]' AND origin='$_POST[origin]' AND destination='$_POST[destination]'
		GROUP BY date_of_ride,time_of_ride,origin,destination,car_brand,car_model,K.rid_number");
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
			<th scope='col'>New Bid</th>
			</tr></thead><tbody>";
			while ($row=pg_fetch_assoc($result)){
				echo "<tr><td>" .$row["date_of_ride"]. "</td><td>" .$row["time_of_ride"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]. "</td><td>"  .$row["car_brand"]. "</td><td>"  .$row["car_model"].  "</td><td>"  .$row["num_bidders"].  "</td><td>"  .$row["point"].  "</td><td>"  .$row["max_bid"].
				"</td><td> 
				<form name='".$row[rid_number]."' method=\"POST\" >
				<input type=\"text\" name=\"new_bid\" />
				<input type=\"submit\" name='bid' value=\"Bid\">
				<input type=\"hidden\" name=\"rid_number\" value='".$row[rid_number]."'/>
				</form>
				</td></tr>";
			}
			if (isset($_POST['bid'])) {
				$result1 = pg_query($db, "UPDATE bid SET point = ".$_POST[new_bid]."
				WHERE rid_number = '".$_POST[rid_number]."'
				AND phone_number =" .$user_id. ";"); 
				echo "<meta http-equiv='refresh' content='0'>";
				}
			echo "</tbody></table>";
		}
	}
    ?>  


</body>
</html>
