<?php
// Start the session
session_destroy();
session_start();
?>
<!DOCTYPE html>  
<head>
  <title>Sign In</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <h2>Sign In</h2>
    <ul>
      <form name="display" action="signin.php" method="POST" >
        <li>Phone Number: </li>
        <li><input type="text" name="phone" /></li>
        <li>Password:</li>
        <li><input type="password" name="password" /></li>
        <li><input type="submit" name="login" /></li>
      </form>
    </ul>
    <a href="signup.php">Don't have a account? Sign up here!</a>
  </div>
  <?php
    if (isset($_POST['login'])) {
  	// Connect to the database. Please change the password in the following line accordingly
      $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=Ml271slwmx");	
      $result = pg_query($db, "SELECT * FROM appuser WHERE phone_number='" .$_POST[phone]. "' AND password='" .$_POST[password]. "';");		// Query template
      $row    = pg_fetch_assoc($result);		// To store the result row

      if (!$row) {
          echo "The user name or password is incorrect!";
      } else {
          echo "Logged in!";
          $_SESSION["user_id"] = $row["phone_number"];
          $_SESSION["password"] = $row["password"];
          echo $_SESSION["user_id"];
          header("Location: ./index.php");
          exit;
      }
    }
  ?>  
</body>
</html>
