<!DOCTYPE html>
<head>
	<title>User Profile</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>li {list-style: none;}</style>
</head>
<body>
	<h2>User profile</h2>



	<?php 
	$db = pg_connect("host=localhost port=5432 dbname=Team25 user=postgres password=postgres");

	$result = pg_query($db, "SELECT car_id, car_brand, car_model FROM car WHERE phone_number = '9038899211'  ");

	$row = pg_fetch_assoc($result);

	if (!$result){
		echo "You haven't registered a car yet! \n";
		echo("<button onclick=\"location.href='regiscar.php'\">Register a car</button>");

	}else{
		echo $row["car_id"];
		echo $row["car_brand"]; 
		echo $row["car_model"];
	}
	?>
</body>
</html>