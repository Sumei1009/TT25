<!DOCTYPE html>  
<head>
  <title>Search ride</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
  <style>p.indent{ padding-left: 1.0 em }</style>

</head>
<body>
  <h2>Search ride</h2>
   <ul>
    <form name="display" action="searchride.php" method="POST" >
	<li> Date: Origin:  Destination: </li>
	<li><input type="date" name="date" />       <input type="text" name="origin" />    
	<input type="text" name="destination" />  <input type="submit" name="submit" value="search"></li>
	</form>
   </ul>


  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=project1 user=wthanw password=qchenxm");	
	if (!($_POST['destination'])&&!($_POST['origin'])&&!($_POST['date'])){
		$result=pg_query($db, "SELECT * FROM ride_generate NATURAL JOIN car");
		}
	elseif (!(($_POST['destination'])&&($_POST['origin'])&&($_POST['date']))){
		//do nothing
		}
	else{
		$result = pg_query($db, "SELECT * FROM ride_generate NATURAL JOIN car WHERE date_of_ride='$_POST[date]' AND origin='$_POST[origin]' AND destination='$_POST[destination]'");
		}
	
	if (isset($_POST['submit'])) {
		if (!$result&&!(($_POST['destination'])&&($_POST['origin'])&&($_POST['date']))){
			echo 'incomplete information';
			}
		elseif (!$result){
			echo 'Ops! It is empty';
		}
		else {
			echo 'Car brand';
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo 'Car model';
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo 'Date';
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo 'Time';
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo  'Start';
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo  'End';
			echo '<br>';
			while ($row=pg_fetch_assoc($result)){

			echo $row['car_brand'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo $row['car_model'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo $row['date_of_ride'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo $row['time_of_ride'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo $row['origin'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp';
			echo $row['destination'];
			echo '<br>';
			}
		}
	}
    ?>  


</body>
</html>
