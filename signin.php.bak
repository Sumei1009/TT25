<?php
// Start the session
session_destroy();
session_start();
?>
<!DOCTYPE html>  
<head>
  <title>Sign up</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
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
