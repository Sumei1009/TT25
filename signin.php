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
  <div class="container col-4" style="margin-top: 40px;">
    <h2>Sign In</h2>
      <form name="display" action="signin.php" method="POST" >
        <div class="form-group">
          <label>Phone Number</label>
          <input class="form-control" type="text" name="phone" placeholder="Phone Number" />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password"/>
        </div>
        <input class='btn btn-outline-primary' type="submit" name="login" />
      </form>
      <br/>
    <a href="signup.php">Don't have a account? Sign up here!</a>
  </div>
  <?php
    if (isset($_POST['login'])) {
  	// Connect to the database. Please change the password in the following line accordingly
      $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");	
      $result = pg_query($db, "SELECT * FROM appuser WHERE phone_number='" .$_POST[phone]. "' AND password='" .$_POST[password]. "';");		// Query template
      $row    = pg_fetch_assoc($result);		// To store the result row

      if (!$row) {
          echo "The user name or password is incorrect!";
      } else {
        if ($row["isadmin"] != 'f'){
          echo "Logged in as Admin!";
          $_SESSION["user_id"] = $row["phone_number"];
          $_SESSION["password"] = $row["password"];
          $_SESSION["isadmin"] = $row["isadmin"];
          echo $_SESSION["user_id"];
          sleep(1);
          header("Location: ./admin.php");
          exit;
        }
          echo "Logged in!";
          $_SESSION["user_id"] = $row["phone_number"];
          $_SESSION["password"] = $row["password"];
          $_SESSION["isadmin"] = $row["isadmin"];
          echo $_SESSION["user_id"];
          sleep(1);
          header("Location: ./index.php");
          exit;
      }
    }
  ?>  
</body>
</html>
