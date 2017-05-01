 <?php
	require_once('includes/functions.php');

	// NEED to start the session BEFORE any ECHO or HTML
	session_name('smuth4_week12'); // needs to come before session_start
	session_start();

	// connect to database
	require_once('includes/world.db.php');

	// get city id from URL
	$cityAttractionID = formVal('cityAttractionID', 1); 

	$sql = "SELECT *
			FROM CityAttraction
			WHERE CityAttractionID = '$cityAttractionID'
			LIMIT 1";

	// execute query
	$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
	
	// get ONE record from the database
	$cityAttraction = mysqli_fetch_array($result);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Delete <?= $cityAttraction['Name'] ?></title>
</head>

<body>
	<h3>Debug session</h3>
	<pre><?php print_r($_SESSION); ?></pre>
	
	<h1>Delete <?= $cityAttraction['Name'] ?></h1>
	<?php
	// add new attraction
	if(isset($_POST['submit'])){
		// get all the values from the form
		$submit = formVal('submit');
		
		// DO YOUR VALIDATION HERE
		
		if($submit == "Yes"){
			// create DELETE statement
			$sql = "DELETE FROM `CityAttraction` 
					WHERE `CityAttractionID` = $cityAttractionID
					LIMIT 1";

			// execute sql
			$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
		}
		
		// redirect back to city
		header('Location: city.php?cityId=' . $cityAttraction['CityId']);
		
	}
		
	mysqli_close($db);
	?>


	<form method="post">
		<p>Are you sure you want to delete <strong><?= $cityAttraction['Name'] ?></strong>?</p>
		
		<input type="hidden" name="cityAttractionID" value="<?= $cityAttractionID ?>">
		
		<input type="submit" name="submit" value="Yes">
		<input type="submit" name="submit" value="No">
	</form>

	
</body>
</html>