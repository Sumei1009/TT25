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
  <!-- <script>
    function logout() {
      console.log("Logout!!!!!");
      $_SESSION = [];
      session_destroy();
      window.location = "http://localhost:8080/cs2102/signin.php";
    };
  </script>  -->
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
            $result2 = pg_query($db, "SELECT * FROM car, ride_generate R WHERE R.rider_id = '{$user_id}' AND car.phone_number = R.rider_id ORDER BY R.rid_number;");
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
                          "<span class='text-warning' style='margin-right:10px;margin-left:10px;'>AT</span>"
                          .$row2["time_of_ride"].
                        "
                      </div>
                    </div>
                    <div id='collapse".$i."' class='collapse' aria-labelledby='heading".$i++."' data-parent='#accordion'>
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
                            <div class='col-6'>";
                                $rid = $row2["rid_number"];
                                $bid = pg_query($db, "SELECT * FROM bid B, appuser A WHERE rid_number = '{$rid}' AND A.phone_number = B.phone_number ORDER BY point desc;");
                                if (!$bid) {
                                  echo "Opps! Something Wrong! Try to refresh!";
                                } else if (pg_num_rows($bid) == 0) {
                                  echo "<div class='bg-waring'>Currently No One Is Bidding Your Ride</div>";
                                } else {
                                  // echo "<form method='POST' id='select_form'></form>";
                                  echo "
                                    <table class='table table-hover table-responsive'>
                                      <tr><th colspan='4'>Who is bidding?</th></tr>
                                      <tr>
                                        <th>#</th>
                                        <th>Phone #</th>
                                        <th style='text-align: center;'>Name</th>
                                        <th>Bidding Points</th>
                                        <th style='text-align: center;'>Status</th>
                                        <th>Select</th>
                                      </tr>";
                                  if ($row2["passenger_id"] == null) {
                                    $k = 1;
                                    while ($row3 = pg_fetch_assoc($bid)) {
                                      echo"
                                        <tr>
                                          <td>".$i."</td>
                                          <td>".$row3['phone_number']."</td>
                                          <td style='text-align: center;'>".$row3['first_name']."<span> </span>".$row3['last_name']."</td>
                                          <td style='text-align: center;'>".$row3['point']."</td>
                                          <td>".$row3['status']."</td>
                                          <td>
                                            <form method='POST' name='select_form".$k++."'>
                                            <input type='hidden' name='phone_number' value='".$row3["phone_number"]."'/>
                                            <input type='hidden' name='rid_number' value='".$row3["rid_number"]."'/>
                                            <input type='submit' class='btn btn-outline-primary' style='padding: .1rem .75rem;' name='submit' value='Select'/>
                                            </form>
                                          </td>
                                        </tr>
                                        ";
                                    }
                                    echo "</table>";
                                  } else {
                                    $j = 1;
                                    while ($row3 = pg_fetch_assoc($bid)) {
                                      echo"
                                        <tr>
                                          <td>".$j."</td>
                                          <td>".$row3['phone_number']."</td>
                                          <td style='text-align: center;'>".$row3['first_name']."<span> </span>".$row3['last_name']."</td>
                                          <td style='text-align: center;'>".$row3['point']."</td>
                                          <td>".$row3['status']."</td>
                                          <td>
                                            <form method='POST' name='select_form".$j++."'>
                                            <input disabled type='submit' name='submit' value='Select'/>
                                            </form>
                                          </td>
                                        </tr>
                                        ";
                                    }
                                    echo "</table>";
                                  }
                                }
                              echo "
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
        if (isset($_POST['submit'])) {
          $rid = $_POST['rid_number'];
          $phone = $_POST['phone_number'];
          $result4 = pg_query($db, "BEGIN; UPDATE bid set status = TRUE where rid_number = '{$rid}' and phone_number = {$phone};");
          $result5 = pg_query($db, "UPDATE bid set status = FALSE where rid_number = '{$rid}' and phone_number <> {$phone};");
          $result6 = pg_query($db, "UPDATE ride_generate set passenger_id = '{$phone}' where rid_number = '{$rid}'; COMMIT;");
          header("Refresh:0");
        }
      }
    ?>
  </div>
</body>
</html>

