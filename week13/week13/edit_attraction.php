<?php
	require_once('includes/functions.php');

	// NEED to start the session BEFORE any ECHO or HTML
	session_name('tkowalch_week12'); // needs to come before session_start
	session_start();

	// generate a new session csrf token if it doesn't exist
	$_SESSION['csrf_token'] = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : md5(uniqid());

	// connect to database
	require_once('includes/world.db.php');

	// get city id from URL
	$cityAttractionId = formVal('cityAttractionId', 1); 
	
	// sanitze out non numeric characters
	$cityAttractionId = intval($cityAttractionId);

	$sql = "SELECT *
			FROM CityAttraction
			WHERE CityAttractionId = '$cityAttractionId'
			LIMIT 1";

	// execute query
	$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
	
	// get ONE record from the database
	$cityAttraction = mysqli_fetch_array($result);


	// DO A CHECK TO SEE IF THE USER HAS ACCESS
	// IF NOT, DISPLAY ERROR

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit <?= $cityAttraction['Name'] ?></title>
</head>

<body>
	<h3>Debug session</h3>
	<pre><?php print_r($_SESSION); ?></pre>
	
	<h1>Edit <?= $cityAttraction['Name'] ?></h1>
	<p>
  <?php
	// set form defaults to values from record
	$name = $cityAttraction['Name'];
	$address = $cityAttraction['Address'];
	$rating = $cityAttraction['Rating'];
	$description = $cityAttraction['Description'];
	$image = $cityAttraction['Image'];
	
	// add new attraction
	if(isset($_POST['submit'])){
		// get all the values from the form
		$name = formVal('name');
		$address = formVal('address');
		$rating = formVal('rating');
		$description = formVal('description');
		$image = formVal('image');
		
		// SANITIZE against XSS attacks
		//$description = strip_tags($description);
		// or
		//$description = htmlspecialchars($description);
		// or sanitize on the way out of the database (during echo)
		
		// DO YOUR VALIDATION HERE
		// assume form is valid
		$isValid = true;
		if(!filter_var($image, FILTER_VALIDATE_URL)){
			$isValid = false;
			// don't forget to output your error message
		}
		
		// sanitize rating, then validate it
		$rating = filter_var($rating, FILTER_SANITIZE_NUMBER_FLOAT);
		if($rating < 0 or $rating > 5){
			$isValid = false;
			// don't forget to output your error message
		}
		
		// validate CSRF token
		if($_POST['csrf_token'] != $_SESSION['csrf_token']){
			$isValid = false;
			echo "INVALID TOKEN";
		}
		
		
		
		// only update if valid
		if($isValid){
			// create INSERT statement
			$sql = "UPDATE `CityAttraction` SET 
					 `Name` = ?, 
					 `Address` = ?, 
					 `Description` = ?, 
					 `Rating` = ?, 
					 `Image` = ?
					WHERE `CityAttractionId` = ?";
			
			// PREPARE the sql statement
			// this not only adds quotes, but validates the SQL first
			$stmt = mysqli_prepare($db, $sql) or die("Invalid query");

			// bind parameter variables to the query
			// data types are s = string, i = integer, d = double, b = blob
			mysqli_stmt_bind_param($stmt, "sssdsi", $name, $address, $description, $rating, $image, $cityAttractionId);
			
			// execute sql
			$result = mysqli_stmt_execute($stmt) or die("Error in query: " . mysqli_error($db));
			
			// redirect back to city
			header('Location: city.php?cityId=' . $cityAttraction['CityId']);
		}
	}
		
	mysqli_close($db);
	?>
	  
	  
</p>
	<form method="post">
	  <label>Name: <input type="text" name="name" value="<?= $name ?>"></label><br>
		<label>Address: <input type="text" name="address" value="<?= $address ?>"></label><br>
		<label>Rating: <input type="text" name="rating" value="<?= $rating ?>"></label><br>
		<label>Description: <textarea name="description"><?= $description ?></textarea></label><br>
		<label>Image URL: <input type="text" name="image" value="<?= $image ?>"></label><br>
		
		<input type="hidden" name="cityAttractionId" value="<?= $cityAttractionId ?>">
	  <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
	  <input type="submit" name="submit" value="Submit">
	
	</form>

	
</body>
</html>