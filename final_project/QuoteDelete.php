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

$sql = "SELECT *
			FROM Quotes AS Q
                        JOIN OfferedServices AS OS
                        ON Q.OfferedServiceID = OS.OfferedServiceID
			WHERE QuoteID = '$quoteID'
			LIMIT 1";

// execute query
$result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

// get ONE record from the database
$quote = mysqli_fetch_array($result);

$firstname = $quote['FirstName'];
$lastname = $quote['LastName'];
$email = $quote['Email'];
$refferedby = $quote['ReferredBy'];
$comment = $quote['Comment'];
$phone = $quote['Phone'];
$name = $quote['Name'];
$description = $quote['Description'];

$title = "Delete Quote - " . $quoteID;

if (isset($_POST['submit'])) {
     
     $quoteID=mysqli_real_escape_string($db,$quoteID);
     
     if($isValid==true){
     $sql = "DELETE FROM `Quotes` 
					WHERE `QuoteID` = $quoteID
					LIMIT 1";

     // execute sql
     $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
     
     }

     // redirect back to city
     header('Location: QuoteList.php');
}
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
          <div class="container">
               <div class="card">
                    <div class="card-block">
                         <h1 class="text-center"><?= $title ?></h1>
                         <h3>Quote Information</h3>
                         <ul class="list-group row">
                              <li class="list-group-item">
                                   <label>First Name: <?= $firstname ?> </label>
                              </li>
                              <li class="list-group-item">
                                   <label>Last Name: <?= $lastname ?></label>

                              </li>
                              <li class="list-group-item">
                                   <label>Email: <?= $email ?></label>

                              </li>
                              <li class="list-group-item">
                                   <label>Referred: <?= $refferedby ?></label>

                              </li>
                              <li class="list-group-item">
                                   <label>Comment: <?= $comment ?></label>

                              </li>
                              <li class="list-group-item">
                                   <label>Phone Number: <?= $phone ?></label>

                              </li>
                         </ul>
                         <div class="row">
                              <div class="col">
                                   <br>
                              </div>
                         </div>
                         <h3>Service Information</h3>
                         <ul class="list-group row">
                              <li class="list-group-item">
                                   <label>Service Name: <?= $name ?></label>
                              </li>
                              <li class="list-group-item">
                                   <label>Service Description: <?= $description ?></label>
                              </li>
                         </ul>
                    </div>
                    <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">
                    Delete Quote
               </button>
               </div>
               

               <!-- Modal -->
               <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>
                              </div>
                              <div class="modal-body">
                                   Are you sure you want to delete quote <?=$quoteID?>?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <form method="post">
                                        <input type="hidden" name="quoteid" value="<?= $quoteID ?>">
                                        <button type="submit" value="submit" name="submit" class="btn btn-danger">Delete Quote</button>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>