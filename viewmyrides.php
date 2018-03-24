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
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="viewmyrides.php">My Rides</a>
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
          <a class="nav-link" href="signin.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h2 class="d-block p-2 bg-light text-warning" style="margin-bottom: 0;">My Rides:</h2>
    <?php
      $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres"); 
      $result = pg_query($db, "SELECT * FROM car WHERE phone_number = '{$user_id}';");
      if (!$result){
        echo "Invalid query";
      } else {
        if (pg_num_rows($result) == 0) {
          echo "<div class='bg-danger'>You are not a driver. Please register your car if you want to generate rides <a href='/regiscar.php'>here</a></div>";
        } else {
          while($row = pg_fetch_assoc($result)) {
            $car_id = $row["car_id"];
            $result2 = pg_query($db, "SELECT * FROM car, ride_generate R WHERE R.car_id = '{$car_id}' AND car.car_id = R.car_id ORDER BY date_of_generation desc;");
            if (!$result2) {
              echo "Invalid query";
            } else {
              if (pg_num_rows($result2) == 0) {
                echo "<div>You haven't generated any rides.</div>";
              } else {
                $i = 1;
                echo "<div class='bg-light' id='accordion'>";
                while ($row2 = pg_fetch_assoc($result2)) {
                  echo "
                    <div class='card'>
                      <div class='card-header' style='padding:0.4rem 0.5rem;' id='heading".$i."'>
                          <button class='btn btn-link' data-toggle='collapse' data-target='#collapse".$i."' aria-expanded='false' aria-controls='collapse".$i."'>
                              Car Ride #" .$i.
                          "</button>
                          <span class='text-warning' style='margin-right: 10px;'>FROM</span>"
                          .$row2["origin"]. "<span class='text-warning' style='margin-right:10px;margin-left:10px;'>TO</span>"
                          .$row2["destination"]. "<span class='text-warning' style='margin-right: 10px;margin-left:10px;'>ON</span>" .$row2["date_of_ride"].
                        "
                      </div>
                    </div>
                    <div id='collapse".$i."' class='collapse' aria-labelledby='heading".$i++."' data-parent='#accordion'>
                      <div class='car-body'>
                        <div class='container bg-waring'>
                          <div class='row'>
                            <div class='col-1 text-light'>
                            </div>
                            <div class='col-9 text-light'>
                              <table>
                                <tr>
                                  <th>FROM</th>
                                  <th>".$row2["origin"]."</th>
                                <tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ";
                }
                echo "</div>";
              }
            }
          }
        } 
      }
    ?>
  </div>
</body>
</html>

