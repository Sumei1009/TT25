<!DOCTYPE html>  
<head>
  <title>Sign up</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Sign up</h2>
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
      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");	
    $result = pg_query($db, "INSERT INTO appuser VALUES('$_POST[phone]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', null)");		// Query template
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
