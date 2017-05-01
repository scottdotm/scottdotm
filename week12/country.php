<?php
	require_once('includes/functions.php');

	// NEED to start the session BEFORE any ECHO or HTML
	session_name('smuth4_week12'); // needs to come before session_start
	session_start();

	// connect to database
	require_once('includes/world.db.php');

	// get country code from URL
	$code = formVal('code', 'USA'); // USA is used if they land on this page without a code in the URL

	$sql = "SELECT *
			FROM Country
			LEFT JOIN CountryLanguage CL ON Country.Code = CL.CountryCode
			WHERE Code = '$code'
			ORDER BY Percentage DESC
			LIMIT 1";

	// execute query
	$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
	
	// get ONE record from the database
	$country = mysqli_fetch_array($result);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?= $country['Name'] ?></title>
</head>

<body>
	<h3>Debug session</h3>
	<pre><?php print_r($_SESSION); ?></pre>
	
	<h1><?= $country['Name'] ?></h1>
	<p><?= $country['Name'] ?> is located in <?= $country['Region'] ?> and is home to <?= $country['Population'] ?> people who primarily speak <?= $country['Language'] ?>.</p>
	<p><a href="world.php">&larr; Back</a></p>
	<hr>
	<h3>Cities</h3>
	<?php
	
	
	$sort = formVal('sort', 'Name');
	
	$sql = "SELECT *
			FROM City
			WHERE CountryCode = '$code'
			ORDER BY $sort";
	
	// execute query
	$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
	
	// check if there was any results
	if(mysqli_num_rows($result)){
		echo '<ul>';
		
		while($row = mysqli_fetch_array($result)){
			echo '<li><a href="city.php?cityId=' . $row['ID'] . '">' . $row['Name'] . '</a></li>';
		}
		
		echo '</ul>';
	}else{
		echo '<p>No cities found.</p>';
	}
		
	mysqli_close($db);
	?>



	
</body>
</html>