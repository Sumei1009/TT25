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
    <title>Current Bids</title>
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
            <a class="nav-link" href="index.php">My Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">My Car</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewmyrides.php">My Rides</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="currentbids.php">Current Bids</a>
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
      <h2 class="d-block p-2 bg-light text-warning" style="margin-bottom: 0;">My Current Bids:</h2>
      <?php
        $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres"); 
        $result = pg_query($db, "SELECT * FROM bid B WHERE B.phone_number = '{$user_id}' ORDER BY B.rid_number;");
        if ($result && pg_num_rows($result)!=0) {
          $i = 1;
          echo "<div class='bg-light' id='accordion'>";
          while ($row = pg_fetch_assoc($result)) {
            $rid = $row["rid_number"];
            $ride = pg_query($db, "SELECT * FROM ride_generate R, car C WHERE R.rid_number = '{$rid}' AND C.phone_number = R.rider_id;");
            $count = pg_query($db, "SELECT count(*) as count, max(point) as max FROM ride_generate R, bid B WHERE R.rid_number = '{$rid}' AND R.rid_number = B.rid_number GROUP BY R.rid_number;");
            if (!$ride) {
              echo "Invalid query";
            } else {
              $row2 = pg_fetch_assoc($ride);
            }
            if (!$count) {
              echo "Invalid query??";
            } else {
              $row3 = pg_fetch_assoc($count);
            }
            echo "
                <div class='card'>
                  <div class='card-header' style='padding:0.4rem 0.5rem;' id='heading".$i."'>
                      <button class='btn btn-link' data-toggle='collapse' data-target='#collapse".$i."' aria-expanded='false' aria-controls='collapse".$i."'>
                          Bid #" .$i.
                      "</button>
                      <span class='text-warning' style='margin-right: 10px;'>FROM</span>"
                      .$row2["origin"]. "<span class='text-warning' style='margin-right:10px;margin-left:10px;'>TO</span>"
                      .$row2["destination"]. "<span class='text-warning' style='margin-right: 10px;margin-left:10px;'>ON</span>" .$row2["date_of_ride"].
                      "<span class='text-warning' style='margin-right:10px;margin-left:10px;'>AT</span>"
                      .$row2["time_of_ride"].
                    "
                  </div>
                </div>
                <div id='collapse".$i."' class='collapse' aria-labelledby='heading".$i."' data-parent='#accordion'>
                  <div class='car-body'>
                    <div class='container'>
                      <div class='row bg-waring'>
                        <div class='col-6'>
                          <table class='table table-hover table-responsive'>
                            <tr>
                              <th style='text-align: left; width:125px;'>Car ID: </th>
                              <td style='text-align: right;width:115px'>".$row2["car_id"]."</td>
                              <th style='text-align: left;'>Ride ID: </th>
                              <td style='text-align: right;'>".$row2["rid_number"]."</td>
                            </tr>
                            <tr>
                              <th style='text-align: left;'>Car Brand: </th>
                              <td style='text-align: right;'>".$row2["car_brand"]."</td>
                              <th style='text-align: left;'>Car Model: </th>
                              <td style='text-align: right;'>".$row2["car_model"]."</td>
                            </tr>
                            <tr>
                              <th style='text-align: left;'>Generated On: </th>
                              <td style='text-align: right;'>".$row2["date_of_generation"]."</td>
                              <th style='text-align: left;'>Passenger: </th>
                              <td style='text-align: right;'>".$row2["passenger_id"]."</td>
                            </tr>
                            <tr>
                              <th style='text-align: left;'>Date of Ride: </th>
                              <td style='text-align: right;'>".$row2["date_of_ride"]."</td>
                              <th style='text-align: left;'>Time of Ride: </th>
                              <td style='text-align: right;'>".$row2["time_of_ride"]."</td>
                            </tr>
                            <tr>
                              <th style='text-align: left;'>Origin: </th>
                              <td style='text-align: right;'>".$row2["origin"]."</td>
                              <th style='text-align: left;'>Destination: </th>
                              <td style='text-align: right;'>".$row2["destination"]."</td>
                            </tr>
                            <tr>
                              <th style='text-align: left;'>Num. of Seats: </th>
                              <td style='text-align: right;'>".$row2["num_of_seats"]."</td>
                              <th style='text-align: left;'>Lowest Bidding Points: </th>
                              <td style='text-align: right;'>".$row2["lowest_bid_point"]."</td>
                            </tr>
                          </table>
                        </div>
                        <div class='col-6'>
                          <br/>
                          <br/>
                          <table>
                            <tr>
                              <th>No. bidders</th>
                              <th>Highest Bids</th>
                              <th>Your current Bids </th>
                              <th>New Bids</th>
                            </tr>
                            <tr>
                              <td>".$row3["count"]."</td>
                              <td>".$row3["max"]."</td>
                              <td>".$row["point"]."</td>
                              <td>
                                <form name='update bidding points".$i++."' method='POST'>
                                  <div class='row'>
                                    <div class='col-8'><input type='text' style='width: 130px;' name='new_bid'/></div>
                                    <div class='col-4'><input type='submit' class='btn btn-outline-primary' name='bid' style='padding: .1rem .75rem;' value='Bid'></div>
                                    <input type='hidden' name='rid_number' value='".$row["rid_number"]."'/>
                                  </div>
                                </form>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
          }
          echo "</div>";
        } else {
          echo "<div class='bg-warning'>Currenly you don't have any bids. Please go to search the rides you like! <a href='/searchride.php'>here</a></div>";
        }
        if (isset($_POST['bid'])) {
          $result1 = pg_query($db, "UPDATE bid SET point = ".$_POST[new_bid]."
          WHERE rid_number = '".$_POST[rid_number]."'
          AND phone_number =" .$user_id. ";"); 
          echo "<meta http-equiv='refresh' content='0'>";
      }
      ?>
    </div>
  </body>
</html>