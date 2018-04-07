<!DOCTYPE html>  
<head>
  <title>Sign up</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container col-4" style="margin-top: 40px;">
    <h2>Sign up</h2>
    <form name="display" action="signup.php" method="POST" >
      <div class="form-group">
        <label>First Name</label>
        <input class="form-control" placeholder="i.e. Alice" type="text" name="fname" />
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input class="form-control" placeholder="i.e. Stone" type="text" name="lname" />
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input class="form-control" placeholder="i.e. 12345678" type="text" name="phone" />
      </div>
      <div class="form-group">
        <label>Gender</label><br>
        <input type="radio" name="gender" value="M" checked><label style="padding-left: 5px; padding-right: 20px;">Male</label>
        <input type="radio" name="gender" value="F"> <label style="padding-left: 5px; padding-right: 20px;">Female</label>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input class="form-control" placeholder="i.e. 11111111" type="password" name="password" />
      </div>
      <input class='btn btn-outline-primary' type="submit" name="submit" />
    </form>
    <br/>
    <a href="signin.php">Already had a account? Sign in here!</a>
  
  <?php
    // include 'global.php';
  	// Connect to the database. Please change the password in the following line accordingly
    $dbpassword = "postgres";
    $user = "postgres";
    $port = 5432;
    $dbname = "Team25";

    $db     = pg_connect("host=localhost port=$port dbname=$dbname user=$user password=$dbpassword");
    // $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");	
    $result = pg_query($db, "INSERT INTO appuser VALUES('$_POST[phone]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', '$_POST[password]', null)");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
    if (isset($_POST['submit'])) {
        if (!$result) {
            echo "<p class='text-danger'>Sign up failed!! Try Again!</p>";
        } else {
            echo "<p class='text-success'>Sign up successful!</p>";
            header("Location: /cs2102/signin.php");
            // exit;
        }
    }
    ?> 
    </div>
</body>
</html>
