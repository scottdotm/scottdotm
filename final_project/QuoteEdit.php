<?php
//include custom functions
require('Includes/Functions.php');
//include database connection
require('Includes/DB.connect');
$isValid = true;
$errorMessage = null;

// NEED to start the session BEFORE any ECHO or HTML
session_name('smuth4_final_project'); // needs to come before session_start
session_start();

// generate a new session csrf token if it doesn't exist
//$_SESSION['csrf_token'] = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : md5(uniqid());
// get city id from URL
$quoteID = formVal('QuoteID', 1);

// sanitze out non numeric characters
$quoteID = intval($quoteID);


$sql = "SELECT FirstName, LastName, Email, ReferredBy, Comment, Phone, Q.OfferedServiceID, Name, Description, QuoteID
			FROM Quotes AS Q
                        JOIN OfferedServices AS OS
                        ON Q.OfferedServiceID = OS.OfferedServiceID
			WHERE QuoteID = '$quoteID'
			LIMIT 1";

// execute query
$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

// get ONE record from the database
$quote = mysqli_fetch_array($result);

$title = 'Quote Edit - ' . $quote['QuoteID'];

// set form defaults to values from record
$firstname = $quote['FirstName'];
$lastname = $quote['LastName'];
$email = $quote['Email'];
$refferedby = $quote['ReferredBy'];
$comment = $quote['Comment'];
$phone = $quote['Phone'];
$serviceID = $quote['OfferedServiceID'];
$name = $quote['Name'];
$description = $quote['Description'];
?>
<!DOCTYPE html>
<!-- 
/**
 * Description of Home
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <?php
     require('Includes/Header.html.php');
     ?>
     <body class="bg-faded">
          <?php
          require('Includes/Navbar.html.php');
          ?>
          <?php
          // add new attraction
          if (isset($_POST['submit'])) {
               // get all the values from the form
               $firstname = htmlspecialchars(formVal('firstname'));
               $lastname = htmlspecialchars(formVal('lastname'));
               $email = htmlspecialchars(formVal('email'));
               $refferedby = htmlspecialchars(formVal('refferedby'));
               $comment = htmlspecialchars(formVal('comment'));
               $phone = htmlspecialchars(formVal('phone'));
               $name = htmlspecialchars(formVal('name'));
               $description = htmlspecialchars(formVal('description'));

               if (!is_numeric($quoteID)) {
                    $isValid = false;
                    $invalidQuoteID = "Invalid Quote ID - Unable to Update DB at this time.";
                    $errorMessage = $invalidQuoteID;
               }


               if ($isValid == true) {

                    // create UPDATE statement
                    $sql = "UPDATE `Quotes` AS Q 
                                   JOIN `OfferedServices` AS OS
                                   ON Q.OfferedServiceID = OS.OfferedServiceID 
                                   SET 
					 `FirstName` = ?, 
					 `LastName` = ?, 
					 `Email` = ?, 
					 `ReferredBy` = ?, 
					 `Comment` = ?,
                                         `Phone` = ?,
                                         `Name` = ?,
                                         `Description` = ?
					WHERE `QuoteID` = ?";


                    // PREPARE the sql statement
                    // this not only adds quotes, but validates the SQL first
                    $stmt = mysqli_prepare($db, $sql) or die("Invalid query");

                    // bind parameter variables to the query
                    // data types are s = string, i = integer, d = double, b = blob
                    mysqli_stmt_bind_param($stmt, "sssssissi", mysqli_real_escape_string($db,$firstname), mysqli_real_escape_string($db,$lastname), mysqli_real_escape_string($db,$email), mysqli_real_escape_string($db,$refferedby), mysqli_real_escape_string($db,$comment), mysqli_real_escape_string($db,$phone), mysqli_real_escape_string($db,$name), mysqli_real_escape_string($db,$description), mysqli_real_escape_string($db,$quoteID));

                    // execute sql
                    $result = mysqli_stmt_execute($stmt) or die("Error in query: " . mysqli_error($db));

                    // redirect back to city
                    header('Location: QuoteList.php');
               }
          }
          ?>
          <div class="container">
               <div class="card">
                    <div class="card-block">
                         <h1><?= $title ?></h1>
                         <form method="post">
                              <div class="form-group">
                                   <label for="firstname">First Name: </label>
                                   <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?>"><br>
                              </div>
                              <div class="form-group">
                                   <label for="lastname">Last Name: </label>
                                   <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastname ?>"><br>
                              </div>
                              <div class="form-group">
                                   <label for="email">Email: </label>
                                   <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>"><br>
                              </div>
                              <div class="form-group">
                                   <label for="refferedby">Reffered By: </label>
                                   <input type="text" class="form-control" id="refferedby" name="refferedby" value="<?= $refferedby ?>"><br>
                              </div>
                              <div class="form-group">
                                   <label for="comment">Comment: </label>
                                   <textarea type="text" class="form-control" id="comment" name="comment" value="<?= $comment ?>"><?= $comment ?></textarea><br>
                              </div>
                              <div class="form-group">
                                   <label for="phone">Phone: </label>
                                   <input type="number"class="form-control" id="phone" name="phone" value="<?= $phone ?>"><br>
                              </div>         

                              <h1>Offered Service <?= $serviceID ?></h1>

                              <div class="form-group">
                                   <label for="name">Service: </label>
                                   <input id="name" class="form-control" value="<?= $name ?>" name="name"><br>
                              </div>
                              <div class="form-group">
                                   <label for="description">Description: </label>
                                   <textarea id="description" class="form-control" name="description"><?= $description ?></textarea><br>
                              </div>
                              <?php
                              if ($isValid == false) {
                                   ?>
                                   <br>
                                   <p style="color:red;"><?= $errorMessage ?></p>
                                   <br>
                                   <?php
                              }
                              ?>

                              <input type="hidden" name="OfferedServiceID" value="<?= $quoteID ?>">

                              <button class="btn btn-lg btn-success col" type="submit" name="submit" value="Submit">Submit</button>

                         </form>
                    </div>
               </div>
          </div>


          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
