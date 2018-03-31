<!DOCTYPE html>  
<head>
  <title>Sign up</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <h2 class="classname">Sign up</h2>
  <ul>
    <form name="display" action="signup.php" method="POST" >
      <li>First Name:</li>
      <li><input type="text" name="fname" /></li>
      <li>Last Name:</li>
      <li><input type="text" name="lname" /></li>
      <li>Phone Number: </li>
      <li><input type="text" name="phone" /></li>
      <li>Gender:</li>
      <li>
        <input type="radio" name="gender" value="M" checked> Male<br>
        <input type="radio" name="gender" value="F"> Female<br>
      </li>
      <li>Password: </li>
      <li><input type="text" name="password" /></li>
      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
  <?php
    // include 'global.php';
  	// Connect to the database. Please change the password in the following line accordingly
    $dbpassword = "wthanw";
    $user = "qchenxm";
    $port = 5432;
    $dbname = "project1";

    $db     = pg_connect("host=localhost port=$port dbname=$dbname user=$user password=$dbpassword");
    // $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");	
    $result = pg_query($db, "INSERT INTO appuser VALUES('$_POST[phone]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', '$_POST[password]', null)");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
    if (isset($_POST['submit'])) {
        if (!$result) {
            echo "Sign up failed!!";
        } else {
            echo "Sign up successful!";
            // header("Location: /cs2102/signin.php");
            // exit;
        }
    }
    ?>  
</body>
</html>
