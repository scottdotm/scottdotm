
<?php
//include custom functions
require('Includes/Functions.php');
//include database connection
require('Includes/DB.connect');
//set title of page
$title = "Scottdotm - Quote";
$isValid = true;
$errorMessage = null;

$filename = basename(__FILE__, '.php');

// NEED to start the session BEFORE any ECHO or HTML
session_name('smuth4_week12'); // needs to come before session_start
session_start();

// get OfferedServiceID from URL and sanitze out non numeric characters
$serviceID = intval(formVal('OfferedServiceID', 1));

$firstName = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastName = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$refferedBy = isset($_POST['refferedby']) ? $_POST['refferedby'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';

if (isset($_POST['submit'])) {
     $firstName = htmlspecialchars(formVal('firstname'));
     $lastName = htmlspecialchars(formVal('lastname'));
     $email = htmlspecialchars(formVal('email'));
     $refferedBy = htmlspecialchars(formVal('refferedby'));
     $comment = htmlspecialchars(formVal('comment'));
     $phone = htmlspecialchars(intval(formVal('phone')));
     

     $inputs = array($firstName, $lastName, $email, $refferedBy, $comment, $phone);

     foreach ($inputs as $i => $input) {
          if (empty($input) == true) {
               $isValid = false;
               $emptyFormValueError = "Please fill out the form. <br>";
               $errorMessage = $emptyFormValueError;
          }
     }
//     if(is_int($phone)==false){
//          $phone = $phone +5;
//          $isValid=false;
//          $notIntError = "Form was expecting Integer Value for Phone. <br>";
//          $errorMessage = $notIntError;
//     }


     // only update if valid
     if ($isValid == true) {
          // create INSERT statement
          $sql = "INSERT INTO `smuth4`.`Quotes` (`FirstName`, `LastName`, `OfferedServiceID`, `Email`, `ReferredBy`, `Comment`, `Phone`) VALUES (?, ?, ?, ?, ?, ?, ?);";

          // PREPARE the sql statement
          // this not only adds quotes, but validates the SQL first
          $stmt = mysqli_prepare($db, $sql) or die("Invalid query");
          
          // bind parameter variables to the query
          // data types are s = string, i = integer, d = double, b = blob
          mysqli_stmt_bind_param($stmt, "ssissss", mysqli_real_escape_string($db,$firstName), mysqli_real_escape_string($db,$lastName), mysqli_real_escape_string($db,$serviceID), mysqli_real_escape_string($db,$email), mysqli_real_escape_string($db,$refferedBy), mysqli_real_escape_string($db,$comment), mysqli_real_escape_string($db,$phone));
          
          // execute sql
          $result = mysqli_stmt_execute($stmt) or die("Error in query: " . mysqli_error($db));

          // redirect back to city
          header('Location: Home.php');
     }
}
?>
<!DOCTYPE html>
<!-- 
/**
 * Description of Quote
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
                         <h1>Quote</h1>
                         <br>
                         <p>Please let us know the details of any project you wish for us to work togeather on.</p>

                         <form method="post">
                              <div class="form-group">
                                   <label for="firstname">First Name: </label>
                                   <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstName ?>" required><br>

                                   <label for="lastname">Last Name: </label>
                                   <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastName ?>" required><br>
                              </div>
                              <div class="form-group">
                                   <label for="email">Email: </label>
                                   <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required><br>
                              </div>
                              <div class="form-group">
                                   <label for="refferedby">Referred By: </label>
                                   <input type="text" class="form-control" id="refferedby" name="refferedby" value="<?= $refferedBy ?>" required><br>
                              </div>
                              <div class="form-group">
                                   <label for="comment">Comment: </label>
                                   <textarea type="text" class="form-control"id="comment" name="comment" value="<?= $comment ?>" required></textarea><br>
                              </div>
                              <div class="form-group">
                                   <label for="phone">Phone: </label>
                                   <input type="number" class="form-control" id="phone" name="phone" value="<?= $phone ?>" required><br>
                              </div>

                              <input type="hidden" name="serviceID" class="form-control" value="<?= $serviceID ?>" required>

                              <?= $errorMessage ?>

                              <button class="btn btn-lg btn-success col" type="submit" name="submit" value="Submit">Submit</button>

                         </form>
                         <?php
                         if (isset($_POST['submit'])) {
                              foreach ($inputs as $i => $input) {
                                   echo $input;
                              }
                         }
                         ?>
                    </div>
               </div>
          </div>

          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
