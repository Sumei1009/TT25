<!DOCTYPE html>  
<head>
  <title>Search ride</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
  <style>p.indent{ padding-left: 1.0 em }</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

   <span class="d-block p-2 bg-primary text-white">Results</span>
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
			echo "<table class='table'><thead><tr>
			<th scope='col'>Date of Ride</th>
			<th scope='col'>Time of Ride</th>
			<th scope='col'>Origin</th>
			<th scope='col'>Destination</th>
			<th scope='col'>Car Brand</th>
			<th scope='col'>Car Model</th>
			</tr></thead><tbody>";
			while ($row=pg_fetch_assoc($result)){
				echo "<tr><td>" .$row["date_of_ride"]. "</td><td>" .$row["time_of_ride"]. "</td><td>" .$row["origin"]. "</td><td>" .$row["destination"]. "</td><td>"  .$row["car_brand"]. "</td><td>"  .$row["car_model"]. "</td> </tr>";
			}
			echo "</tbody></table>";
		}
	}
    ?>  


</body>
</html>
