<?php
require_once('includes/functions.php');
$filename = basename(__FILE__, '.php');
// NEED to start the session BEFORE any ECHO or HTML
session_name('smuth4_week12'); // needs to come before session_start
session_start();

// connect to database
require_once('includes/world.db.php');

// get city id from URL
$cityId = formVal('cityId', 1);

$sql = "SELECT *
			FROM City
			WHERE ID = '$cityId'
			LIMIT 1";

// execute query
$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

// get ONE record from the database
$city = mysqli_fetch_array($result);
?>
<!doctype html>
<html>
     <head>
          <meta charset="UTF-8">
          <title><?= $city['Name'] ?></title>
     </head>

     <body>
          <h3>Debug session</h3>
          <pre><?php print_r($_SESSION); ?></pre>

          <h1><?= $city['Name'] ?></h1>
          <p><?= $city['Name'] ?> is located in <?= $city['District'] ?> and is home to <?= $city['Population'] ?>.</p>
          <p><a href="world.php">&larr; Back</a></p>
          <hr>
          <h3>City Attractions</h3>
          <?php
          // add new attraction
          if (isset($_POST['submit'])) {
               // get all the values from the form
               $name = formVal('name');
               $address = formVal('address');
               $rating = formVal('rating');
               $description = formVal('description');
               $image = formVal('image');
               $userEmail = formVal('email');
               $username = formVal('username');

               $to = $userEmail;
               $subject = "New City Attraction Added to " . $filename . " City ID = " . $cityId;
               $message = "Dear, " . $username . ", <br>"
                       . "Thank you for your suggestions and comments. I am continually looking for suggestions on how to make the site better.<br>"
                       . "<br>"
                       . "Sincerely, <br>"
                       . "Scott Muth";
               
               
               // Always set content-type when sending HTML email
               $headers = "MIME-Version: 1.0" . "\r\n";
               $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

               // More headers
               $headers .= 'From: <scott@scottdotm.com>' . "\r\n";
               
               //Send mail
               mail($to, $subject, $message, $headers);

               // DO YOUR VALIDATION HERE
               // create INSERT statement
               $sql = "INSERT INTO `CityAttraction` 
		(`CityAttractionID`, `CityId`, `Name`, `Address`, `Description`, `Rating`, `Date`, `Image`) VALUES 
		(NULL, '$cityId', '$name', '$address', '$description', '$rating', NOW(), '$image');";

               // execute sql
               $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

               // redirect back to city to prevent duplicate submissions
               header('Location: city.php?cityId=' . $cityId);
          }


          // get attractions
          $sql = "SELECT *
			FROM CityAttraction
			WHERE CityId = '$cityId'
			";

          // execute query
          $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

          // check if there was any results
          if (mysqli_num_rows($result)) {

               while ($row = mysqli_fetch_array($result)) {
                    echo '<h3>' . $row['Name'] . '</h3>
				<p>Address: ' . $row['Address'] . '<br>
					Rating: ' . $row['Rating'] . '<br>
					Description: ' . nl2br($row['Description']) . '<br>
					Date: ' . $row['Date'] . '<br>
					<img src="' . $row['Image'] . '" height="150"><br>
			<a href="edit_attraction.php?cityAttractionID=' . $row['CityAttractionID'] . '&cityId=' . $cityId . '">[Edit]</a>
			<a href="delete_attraction.php?cityAttractionID=' . $row['CityAttractionID'] . '">[Delete]</a>
					</p>';
               }
          } else {
               echo '<p>No attractions found.</p>';
          }

          mysqli_close($db);
          ?>

          <hr>
          <h4>New Attraction</h4>
          <form method="post">
               <label>User Email: <input type="text" name="email"></label><br>
               <label>User Name: <input type="text" name="username"></label><br>
               <label>Name: <input type="text" name="name"></label><br>
               <label>Address: <input type="text" name="address"></label><br>
               <label>Rating: <input type="text" name="rating"></label><br>
               <label>Description: <textarea name="description"></textarea></label><br>
               <label>Image URL: <input type="text" name="image"></label><br>

               <input type="hidden" name="cityId" value="<?= $cityId ?>">

               <input type="submit" name="submit" value="Submit">

          </form>


     </body>
</html>