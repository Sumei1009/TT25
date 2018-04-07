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
  <title>Admin</title>
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
    //$result = pg_query($db, "SELECT first_name, last_name FROM appuser WHERE phone_number = '" .$user_id. "';");
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

  <span class="d-block p-2 bg-primary text-white">All Users Information</span>
  <?php
    // Recently generated rides by drivers
    $result = pg_query($db, "SELECT * FROM appuser;");   // Query template
    if (pg_num_rows($result)!=0){
    // output data of each row
      echo "<table class='table'><thead><tr>
      <th scope='col'>First name</th>
      <th scope='col'>Last name</th>
      <th scope='col'>Phone number</th>
      <th scope='col'>Gender</th>
      <th scope='col'>Password</th>
      <th scope='col'>Admin Authority</th>
      <th scope='col'>Delete</th>
      </tr></thead><tbody>";
      while($row = pg_fetch_assoc($result)) {
        echo "<tr><td>" .$row["first_name"]. "</td><td>" .$row["last_name"]. "</td><td>" .$row["phone_number"]. "</td><td>" .$row["gender"]. "</td><td>".$row["password"]. "</td><td>" .$row["isadmin"]. "</td>
          <td>
          <form name='".$row["phone_number"]."' method=\"POST\">
              <input type=\"hidden\" name= \"phone_number\" value='".$row["phone_number"]."' />
              <input type=\"submit\" name=\"delete1\" value=\"Delete\" />
          </form>
          </td>

        </tr>" ;
      }
      if (isset($_POST['delete1'])){
        $result = pg_query($db, "DELETE FROM appuser WHERE phone_number = ".$_POST[phone_number]."; ");
        echo "<meta http-equiv='refresh' content='0'>";
      }

      echo "</tbody></table>";
    }
  ?>

  <span class="d-block p-2 bg-primary text-white">All Current Rides</span>
  <?php
    // Connect to the database. Please change the password in the following line accordingly

    $result = pg_query($db, "SELECT * FROM ride_generate;");   // Query template
    if (pg_num_rows($result)!=0){
    // output data of each row
      echo "<table class='table'><thead><tr>
      <th scope='col'>Ride number</th>
      <th scope='col'>Rider ID</th>
      <th scope='col'>Date of generateion</th>
      <th scope='col'>Origin</th>
      <th scope='col'>Destination</th>
      <th scope='col'>Number of Seats</th>
      <th scope='col'>Date of ride</th>
      <th scope='col'>Time of tide</th>
      <th scope='col'>Passeneger ID</th>
      <th scope='col'>Lowest Bidding point</th>
      </tr></thead><tbody>";
      while($row = pg_fetch_assoc($result)) {
        echo "<tr><td>" .$row["rid_number"]. "</td><td>" .$row["rider_id"]. "</td><td>" .$row["date_of_generation"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]."</td><td>" .$row["num_of_seats"]."</td><td>" .$row["date_of_ride"]."</td><td>" .$row["time_of_ride"]."</td><td>" .$row["passenger_id"]."</td><td>" .$row["lowest_bid_point"]."</td>
        <td>
          <form name='".$row["rid_number"]."' method=\"POST\">
              <input type=\"hidden\" name= \"rid_number\" value='".$row["rid_number"]."' />
              <input type=\"submit\" name=\"delete2\" value=\"Delete\" />
          </form>
        </td>
        </tr>" ;
      }
      if (isset($_POST['delete2'])){
        $result2 = pg_query($db, "DELETE FROM ride_generate WHERE rid_number = '".$_POST[rid_number]."'; ");
        echo "<meta http-equiv='refresh' content='0'>";
      }
      echo "</tbody></table>";
    }
  ?>
  
  <span class='d-block p-2 bg-primary text-white'>All Current Bids</span>
  <?php
    // Connect to the database. Please change the password in the following line accordingly
    $result = pg_query($db, "SELECT * FROM bid;");   // Query template
    // output data of each row
    echo "<table class='table'><thead><tr>
    <th scope='col'>Phone Number</th>
    <th scope='col'>Ride Number</th>
    <th scope='col'>Rider ID</th>
    <th scope='col'>Status</th>
    <th scope='col'>Points</th>
    </tr></thead><tbody>";
    while($row = pg_fetch_assoc($result)) {
      echo "<tr><td>" .$row["phone_number"]. "</td><td>" .$row["rid_number"]. "</td><td>" .$row["rider_id"]. "</td><td>" .$row["status"]. "</td><td>" .$row["point"]."</td>
      <td>
          <form name='".$row["phone_number"]."' method=\"POST\">
              <input type=\"hidden\" name= \"phone_number\" value='".$row["phone_number"]."' />
              <input type=\"hidden\" name= \"rid_number\" value='".$row["rid_number"]."' />
              <input type=\"submit\" name=\"delete3\" value=\"Delete\" />
          </form>
      </td>
      </tr>" ;
      }
      if (isset($_POST['delete3'])){
        $result3 = pg_query($db, "DELETE FROM bid WHERE phone_number = ".$_POST[phone_number]." AND rid_number = '".$_POST[rid_number]."'; ");
        echo "<meta http-equiv='refresh' content='0'>";
      }
    echo "</tbody></table>";
  
    
  ?>

  <span class='d-block p-2 bg-primary text-white'>All Cars</span>
  <?php
    // Connect to the database. Please change the password in the following line accordingly
    $result = pg_query($db, "SELECT * FROM car;");   // Query template
    // output data of each row
    echo "<table class='table'><thead><tr>
    <th scope='col'>Car ID</th>
    <th scope='col'>Car Brand</th>
    <th scope='col'>Car Model</th>
    <th scope='col'>Owner</th>
    </tr></thead><tbody>";
    while($row = pg_fetch_assoc($result)) {
      echo "<tr><td>" .$row["car_id"]. "</td><td>" .$row["car_brand"]. "</td><td>" .$row["car_model"]. "</td><td>" .$row["phone_number"]. "</td>
      <td>
          <form name='".$row["phone_number"]."' method=\"POST\">
              <input type=\"hidden\" name= \"phone_number\" value='".$row["phone_number"]."' />
              <input type=\"submit\" name=\"delete4\" value=\"Delete\" />
          </form>
      </td>
      </tr>" ;
      }
      if (isset($_POST['delete4'])){
        $result4 = pg_query($db, "DELETE FROM car WHERE phone_number = ".$_POST[phone_number]."; ");
        echo "<meta http-equiv='refresh' content='0'>";
      }
    echo "</tbody></table>";
  
    
  ?>






  </div>


</body>
</html>
