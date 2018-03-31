<?php
// Start the session
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    header("Location: ./signin.php");
    exit;
}
?>
<!DOCTYPE html>  
<head>
  <title>Update Car</title>
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
  <h2>Update Car</h2>
   <ul>
    <form name="display" action="updatecar.php" method="POST" >
	<li> Car Id: Car Brand:  Car Model: </li>
	<li>  <input type="text" name="car_id" />  <input type="text" name="car_brand" />   <input type="text" name="car_model" /> 
	<input type="submit" name="submit" value="update"></li>
	</form>
   </ul>
<?php
	if($_POST['car_id']&&$_POST['car_brand']&&$_POST['car_model']){
		// Connect to the database. Please change the password in the following line accordingly
	    $db  = pg_connect("host=localhost port=5432 dbname=project1 user=wthanw password=qchenxm");	
		$result = pg_query($db, "UPDATE car SET car_id='$_POST[car_id]',car_model='$_POST[car_model]',car_brand='$_POST[car_brand]' WHERE phone_number='$user_id'");
		if (isset($_POST['submit'])){
				if ($result){
					echo "update successfully";
					}
				else{
					echo "update failed";
				}
			}
		}
		else{
			if (isset($_POST['submit'])){
				echo "incomplete information";
			}

		}




?>

	
</body>
</html>
