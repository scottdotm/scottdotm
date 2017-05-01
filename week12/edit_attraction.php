<?php
require_once('includes/functions.php');
$isValid = true;
// NEED to start the session BEFORE any ECHO or HTML
session_name('smuth4_week12'); // needs to come before session_start
session_start();
// get city id from URL
$cityId = formVal('cityId', 1);
//php date time
$todayDateTime = date("Y-m-d H:i:s");

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
$sql = "UPDATE `CityAttraction` SET 
     `CheckedOut` = '$todayDateTime'
     WHERE `CityAttractionID` = $cityAttractionID";
// execute query
$checkedOutUpdate = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
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
<?php
// add new attraction
if (isset($_POST['submit'])) {
     // get all the values from the form
     $name = formVal('name');
     $address = formVal('address');
     $rating = formVal('rating');
     $description = formVal('description');

     $image = formVal('image');

     // DO YOUR VALIDATION HERE
     $updateTime = date("Y-m-d H:i:s");
     if ($cityAttraction['CheckedOut'] > $updateTime || $cityAttraction['CheckedOut'] > $todayDateTime) {
          $isValid = false;
     }

     if ($isValid = true) {
          // create INSERT statement
          $sql = "UPDATE `CityAttraction` SET 
				 `Name` = '$name', 
				 `Address` = '$address', 
				 `Description` = '$description', 
				 `Rating` = '$rating', 
				 `Image` = '$image',
                                 `CheckedOut` = ''
				WHERE `CityAttractionID` = $cityAttractionID";

          // execute sql
          $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

          // redirect back to city
          header('Location: city.php?cityId=' . $cityId);
     } else {
          echo"<h1>ERROR SOMEONE ELSE IS EDITING THIS ATTRACTION</h1>";
     }
}

mysqli_close($db);

?>
          <form method="post">
               <label>Name: <input type="text" name="name" value="<?= $cityAttraction['Name'] ?>"></label><br>
               <label>Address: <input type="text" name="address" value="<?= $cityAttraction['Address'] ?>"></label><br>
               <label>Rating: <input type="text" name="rating" value="<?= $cityAttraction['Rating'] ?>"></label><br>
               <label>Description: <textarea name="description"><?= $cityAttraction['Description'] ?></textarea></label><br>
               <label>Image URL: <input type="text" name="image" value="<?= $cityAttraction['Image'] ?>"></label><br>

               <input type="hidden" name="checkedOut" value="<?= $checkOutUpdated['CheckedOut'] ?>">

               <input type="hidden" name="cityId" value="<?= $cityId ?>">

               <input type="hidden" name="cityAttractionID" value="<?= $cityAttractionID ?>">

               <input type="submit" name="submit" value="Submit">

          </form>


     </body>
</html>