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
  <title>Home</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
          <a class="nav-link" href="carprofile.php">Car Profile</a>          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
  <?php
    $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres"); 
    $result = pg_query($db, "SELECT first_name, last_name FROM appuser WHERE phone_number = ' " .$user_id. "';");  
    
        if ($result){
          while ($row = pg_fetch_assoc($result)){
            echo "<h2>Hello! ".$row['first_name']."</h2>";
          }
        }
        else{
          echo "wrong";
        }
    
  ?>

  <span class="d-block p-2 bg-primary text-white">Recent Rides</span>
  <?php
    // Recently generated rides by drivers
    $result = pg_query($db, "SELECT date_of_ride, time_of_ride, origin, destination FROM ride_generate ORDER BY date_of_generation desc LIMIT 5;");   // Query template
    if (pg_num_rows($result)!=0){
    // output data of each row
      echo "<table class='table'><thead><tr>
      <th scope='col'>Date of Ride</th>
      <th scope='col'>Time of Ride</th>
      <th scope='col'>Origin</th>
      <th scope='col'>Destination</th>
      </tr></thead><tbody>";
      while($row = pg_fetch_assoc($result)) {
        echo "<tr><td>" .$row["date_of_ride"]. "</td><td>" .$row["time_of_ride"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]. "</td></tr>";
      }
      echo "</tbody></table>";
    }
  ?>

  <span class="d-block p-2 bg-primary text-white">Your Bids</span>
  <?php
    // Connect to the database. Please change the password in the following line accordingly

    $result = pg_query($db, "select phone_number, rid_number, date_of_ride, time_of_ride,origin, destination, point, (SELECT max(point) from bid where rid_number = b.rid_number) as max_bid,(SELECT count(*) from bid where rid_number = b.rid_number) as num_bidders from bid b NATURAL JOIN ride_generate where phone_number = " .$user_id.";");   // Query template
    if (pg_num_rows($result)!=0){
    // output data of each row
      echo "<table class='table'><thead><tr>
      <th scope='col'>Date of Ride</th>
      <th scope='col'>Time of Ride</th>
      <th scope='col'>Origin</th>
      <th scope='col'>Destination</th>
      <th scope='col'>Number of Bidders</th>
      <th scope='col'>Your Bid</th>
      <th scope='col'>Highest Bid</th>
      <th scope='col'>New Bid</th>
      </tr></thead><tbody>";
      while($row = pg_fetch_assoc($result)) {
        echo "<tr><td>" .$row["date_of_ride"]. "</td><td>" .$row["time_of_ride"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]. "</td><td>" .$row["num_bidders"]."</td><td>" .$row["point"]."</td><td>" .$row["max_bid"]."</td><td>
        <form name='".$row[rid_number]."' method=\"POST\" >
        <input type=\"text\" name=\"new_bid\" />
        <input type=\"submit\" class=\"btn btn-outline-primary\" style=\"padding: .1rem .75rem;\" name='bid' value=\"Bid\">
        <input type=\"hidden\" name=\"rid_number\" value='".$row[rid_number]."'/>
        </form>
        </td></tr>";
      }
      if (isset($_POST['bid'])) {
          $result1 = pg_query($db, "SELECT * FROM UpdateBid(".$_POST[new_bid].",'".$_POST[rid_number]."', ".$user_id.");");
          echo "<meta http-equiv='refresh' content='0'>";
      }
      echo "</tbody></table>";
    }
  ?>
  

  <?php
    // Connect to the database. Please change the password in the following line accordingly
    $result = pg_query($db, "select date_of_ride, time_of_ride,origin, destination, 
(SELECT count(*) from bid where rid_number = R.rid_number) as num_of_bidders 
from ride_generate R
where rider_id = {$user_id}
ORDER BY (date_of_ride, time_of_ride);");   // Query template
    if (pg_num_rows($result)!=0){
      echo  "<span class='d-block p-2 bg-primary text-white'>Your Rides</span>";
    // output data of each row
      echo "<table class='table'><thead><tr>
      <th scope='col'>Date of Ride</th>
      <th scope='col'>Time of Ride</th>
      <th scope='col'>Origin</th>
      <th scope='col'>Destination</th>
      <th scope='col'>Number of Bidders</th>
      </tr></thead><tbody>";
      while($row = pg_fetch_assoc($result)) {
        echo "<tr><td>" .$row["date_of_ride"]. "</td><td>" .$row["time_of_ride"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]. "</td><td>" .$row["num_of_bidders"]."</td></tr>";
      }
      echo "</tbody></table>";
    }
  ?>
  <br/>
  <br/>
</div>

</body>
</html>
