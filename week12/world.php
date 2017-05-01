<?php
	require_once('includes/functions.php');

	// NEED to start the session BEFORE any ECHO or HTML
	session_name('smuth4_week12'); // needs to come before session_start
	session_start();

	// add stuff to session
	$_SESSION['username'] = 'tkowalch';

	// get something from the session
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;

	// delete something from session
	unset($_SESSION['username']);

	// destroy whole session
	//session_destroy();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>THE WORLD!</title>
<style>
	.countries td:nth-child(3) {
		text-align: right;
	}
	
</style>
	
</head>

<body>
	<h3>Debug session</h3>
	<pre><?php print_r($_SESSION); ?></pre>
<?php
	// include database connection (maybe in your header)
	require_once('includes/world.db.php');

	// get sort, default to Country Name
	$sort = formVal('sort', 'Name');
	$dir = formVal('dir', 'ASC');
	$start = formVal('start', 0);
	$per_page = formVal('per_page', 10);
	
	// create query, ALWAYS use double quotes
	//$sql = "SELECT Code, Name, Continent, Population \n"
//    . "FROM Country \n"
//    . "WHERE Population > 0\n"
//    . "ORDER BY $sort $dir";
	
	// or
	$sql = "SELECT Code, Name, Continent, Population 
			FROM Country 
			WHERE Population > 0
			ORDER BY $sort $dir ";
	
	// get total number of records
	$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
	$total_records = mysqli_num_rows($result);
	
	// add limit to query to fetch just one page
	$sql .= " LIMIT $start, $per_page";
		
	// execute query
	// $result is just a REFERENCE to the database result
	$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
	
	// output results
	// loop while we have more rows
?>
		<form method="get">
			<label>Per page: 
				<select name="per_page" onchange="this.form.submit();">
					<option value="10" <?= $per_page == 10 ? "selected" : ""?> >10</option>
					<option value="50" <?= $per_page == 50 ? "selected" : ""?> >50</option>
					<option value="100" <?= $per_page == 100 ? "selected" : ""?> >100</option>
					<option value="100000000000000" <?= $per_page == 100000000000000 ? "selected" : ""?> >All</option>
				</select>
			</label>
			<!--<input type="hidden" name="start" value="0">-->
			<noscript>
				<input type="submit" value="Submit">
			</noscript>
		</form>
		<table class="countries">
			<thead>
				<tr>
					<td><a href="?sort=Name&dir=<?= ($sort == "Name" and $dir == "ASC") ? "DESC" : "ASC" ?>">Name</a></td>
					<td><a href="?sort=Continent&dir=<?= ($sort == "Continent" and $dir == "ASC") ? "DESC" : "ASC" ?>">Continent</a></td>
					<td><a href="?sort=Population&dir=<?= ($sort == "Population" and $dir == "ASC") ? "DESC" : "ASC" ?>">Population</a></td>
				</tr>
			</thead>
			<tbody>
	<?php
	// output results
	// loop while we have more rows
	while($row = mysqli_fetch_array($result)){
		// $row is one record from the database
		// $row only contains the columns you "SELECT"ed
		// when linking to another file, use the primary key
		echo '<tr>
				<td><a href="country.php?code=' . $row['Code'] . '">' . $row['Name'] . '</a></td>
				<td>' . $row['Continent'] . '</td>
				<td>' . $row['Population'] . '</td>
			</tr>';
	}
	?>
			</tbody>
			<tfoot>
				<tr>
					<?php
						$prev_start = $start - $per_page;
						$next_start = $start + $per_page;
						
						// set previous start to 0 if we don't have a "full" page to go back to
						if($prev_start < 0 and $start > 0){
							$prev_start = 0;
						}
					?>
					<td>
						<?php
						if($prev_start >= 0): 
							echo '<a href="?start='.$prev_start.'&per_page='.$per_page.'">Prev</a>';
						endif;
						?>
					</td>
					<td></td>
					<td>
						<?php if(($next_start + 1) <= $total_records): ?>
							<a href="?start=<?= $next_start ?>&per_page=<?= $per_page ?>">Next</a>
						<?php endif; ?>
					</td>
				</tr>
			</tfoot>
		</table>
	
	
	<?php
	
	
	
	

	// close database connection (maybe in your footer)
	mysqli_close($db);
?>
</body>
</html>