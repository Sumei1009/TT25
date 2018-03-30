<!DOCTYPE html>
<html>
<head>
	<title>Register a car</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>li {list-style: none;}</style>
</head>
<body>

	<h2>Register a car</h2>

	<ul>
		<form name="display" action="regiscar.php" method="POST">
			<li>Car Id:</li>
			<li><input type="text" name="car_id" /></li>
			<li>Car Brand:</li>
			<li><input type="text" name="car_brand" /></li>
			<li>Car Model:</li>
			<li><input type="text" name="car_model" /></li>
			<li><input type="submit" name="submit" /></li>			
		</form>
	</ul>

	<button onclick="location.href='userprofile.php'">Go Back</button>

	<?php 
	$db = pg_connect("host=localhost port=5555 dbname=Team25 user=postgres password=237273");

	$result = pg_query($db, "INSERT INTO car VALUES('$_POST[car_id]'. '$_POST[car_brand]', '$_POST[car_model]',   '1111111')");

	$row = pg_fetch_assoc($result);

	if (isset($_POST['submit'])) {
        if (!$result) {
            echo "Update failed!!";
        } else {
            echo "Update successful!";
        }
    }

	?>

</body>
</html>