<?php
require_once('Includes/Assets/DB.Connect/Connect.php');
require_once('Includes/Assets/Functions/Function.php');
// NEED to start the session BEFORE any ECHO or HTML
session_name('ScottDotM'); // needs to come before session_start
session_start();
?>
<!DOCTYPE html>
<!-- 
/**
 * Description of Images
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <?php
     require_once('Includes/HTML/Header.php');
     ?>
     <body>
          <?php
          require_once('Includes/HTML/Navbar.php');
          $isValid = true;
          $errorMessage = '';
          //If the user is a new user, he must be adding himself as a user
          if (empty($_SESSION['userId'])) {
               if (isset($_POST['userSubmit'])) {
                    $login = htmlspecialchars(formVal('Login'));
                    $password = htmlspecialchars(formVal('Password'));
                    $confirmPassword = htmlspecialchars(formVal('ConfirmPassword'));
                    $firstName = htmlspecialchars(formVal('FirstName'));
                    $lastName = htmlspecialchars(formVal('LastName'));
                    $email = htmlspecialchars(formVal('Email'));
                    $inputs = array($login, $password, $confirmPassword, $firstName, $lastName, $email);
                    foreach ($inputs as $i => $input) {
                         if (empty($input) == true) {
                              $isValid = false;
                              $errorMessage = "Form needs to be filled out fully. " . $input;
                         }
                    }
                    if (strcmp($password, $confirmPassword) != 0) {
                         $isValid = false;
                         $errorMessage = 'Passwords must match.';
                    }
                    if ($isValid == true) {
                         $password = password_hash($password, PASSWORD_DEFAULT);
                         // create INSERT statement
                         $sql = "INSERT INTO `users` (`Login`, `Hash`, `FirstName`, `LastName`, `Email`) VALUES (?, ?, ?, ?, ?);";
                         // PREPARE the sql statement
                         // this not only adds quotes, but validates the SQL first
                         $stmt = mysqli_prepare($db, $sql) or die("Invalid query");
                         // bind parameter variables to the query
                         // data types are s = string, i = integer, d = double, b = blob
                         mysqli_stmt_bind_param($stmt, "sssss", mysqli_real_escape_string($db, $login), mysqli_real_escape_string($db, $password), mysqli_real_escape_string($db, $firstName), mysqli_real_escape_string($db, $lastName), mysqli_real_escape_string($db, $email));
                         // execute sql
                         $result = mysqli_stmt_execute($stmt) or die("Error in query: " . mysqli_error($db));
                         /* close statement */
                         mysqli_stmt_close($stmt);
                         //Destory Session - do not store login/password in Sessions longer than they need to be.
                         session_destroy();
                         // redirect back to Home
                         header('Location: Home');
                    }
               }
               //If the user is not a new user - he must be editing his information. DONE BECAUSE THE FORMS ARE IDENTICAL.
          } else if (!empty($_SESSION['userId'])) {
               $userID = intval($_SESSION['userId']);
               if ($stmt = mysqli_prepare($db, "SELECT Login, FirstName, LastName, Email, Hash FROM `users` WHERE UserID = ? LIMIT 1")) {
                    /* bind parameters for markers */
                    mysqli_stmt_bind_param($stmt, "i", $userID);
                    /* execute query */
                    mysqli_stmt_execute($stmt);
                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt, $login, $firstName, $lastName, $email, $hashed);
                    /* fetch value */
                    mysqli_stmt_fetch($stmt);
                    /* close statement */
                    mysqli_stmt_close($stmt);
               } else {
                    $errorMessage = "Something went wrong preparing SELECT statement.";
               }
               if (isset($_POST['userSubmit'])) {
                    $login = htmlspecialchars(formVal('Login'));
                    $password = htmlspecialchars(formVal('Password'));
                    $confirmPassword = htmlspecialchars(formVal('ConfirmPassword'));
                    $firstName = htmlspecialchars(formVal('FirstName'));
                    $lastName = htmlspecialchars(formVal('LastName'));
                    $email = htmlspecialchars(formVal('Email'));
                    //Check password validation
                    if (password_verify($password, $hashed)) {
                         if (strcmp($password, $confirmPassword) != 0) {
                              $isValid = false;
                              $errorMessage = 'Passwords must match.';
                         }
                         $password = password_hash($password, PASSWORD_DEFAULT);
                         if ($isValid) {
                              // create UPDATE statement
                              $sql = "UPDATE `users` 
                                        SET `Login` = ?,
                                        `Hash` = ?,
                                        `FirstName` = ?,
                                        `LastName` = ?,
                                        `Email` = ? 
                                   WHERE `users`.`UserID` = ?";
                              // PREPARE the sql statement
                              // this not only adds quotes, but validates the SQL first
                              $stmt = mysqli_prepare($db, $sql) or die("Invalid query");
                              // bind parameter variables to the query
                              // data types are s = string, i = integer, d = double, b = blob
                              mysqli_stmt_bind_param($stmt, "sssssi", mysqli_real_escape_string($db, $login), mysqli_real_escape_string($db, $password), mysqli_real_escape_string($db, $firstName), mysqli_real_escape_string($db, $lastName), mysqli_real_escape_string($db, $email), mysqli_real_escape_string($db, $userID));
                              // execute sql
                              mysqli_stmt_execute($stmt) or die("Error in query: " . mysqli_error($db));
                              unset($_SESSION['/CreateAccount']);
                              // redirect back to Home
                              header('Location: CreateAccount');
                         }
                    } else if (!password_verify($password, $hashed)) {
                         $isValid = false;
                         $errorMessage = "Password is incorrect.";
                    }
               }
               
          }
          ?>
          <div class="container">
               <div class="card">
                    <div class="card-block">
                         <h3>Debug session</h3>
                         <pre><?php print_r($_SESSION); ?></pre>
                         <form method="post">
                              <div class="form-group">
                                   <label for="Login">Login</label>
                                   <input type="text" name="Login" id="Login" value="<?= $login ?>" class="form-control col" >
                              </div>
                              <div class="form-group">
                                   <label for="Password">Password</label>
                                   <input type="password" name="Password" id="Password" value="<?= $password ?>" class="form-control col" >
                              </div>
                              <div class="form-group">
                                   <label for="ConfirmPassword">Confirm Password</label>
                                   <input type="password" name="ConfirmPassword" id="ConfirmPassword" value="<?= $confirmPassword ?>" class="form-control col" >
                              </div>
                              <div class="form-group">
                                   <label for="FirstName">First Name</label>
                                   <input type="text" name="FirstName" id="FirstName" value="<?= $firstName ?>" class="form-control col" >
                              </div>
                              <div class="form-group">
                                   <label for="LastName">Last Name</label>
                                   <input type="text" name="LastName" id="LastName" value="<?= $lastName ?>" class="form-control col" >
                              </div>
                              <div class="form-group">
                                   <label for="Email">Email</label>
                                   <input type="email" name="Email" id="Email" value="<?= $email ?>" class="form-control col" >
                              </div>
                              <?php if($isValid == false){ ?>
                              <div class="alert alert-danger" role="alert">
                                   <strong>Oh snap!</strong> <p><?=$errorMessage?></p>
                              </div>
                              <?php } ?>
                              <div class="form-group">
                                   <button type="submit" name="userSubmit" class="btn btn-lg btn-primary col">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
          <?php
          require_once('Includes/HTML/Footer.php');
          mysqli_close($db);
          ?>
     </body>
</html>
