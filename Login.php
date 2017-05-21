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
          $login = formVal('Login');
          $password = formVal('Password');
          if (isset($_POST['loginUserSubmit'])) {
               $login = htmlspecialchars(formVal('Login'));
               $password = htmlspecialchars(formVal('Password'));
               $inputs = array($login, $password);
               foreach ($inputs as $i => $input) {
                    if (empty($input) == true) {
                         $isValid = false;
                         $errorMessage = "Form needs to be filled out fully. " . $input;
                    }
               }
               if ($isValid == true) {
                    /* create a prepared statement */
                    if ($stmt = mysqli_prepare($db, "SELECT Login, Hash, UserID FROM `users` WHERE Login = ? LIMIT 1")) {
                         /* bind parameters for markers */
                         mysqli_stmt_bind_param($stmt, "s", $login);
                         /* execute query */
                         mysqli_stmt_execute($stmt);
                         /* bind result variables */
                         mysqli_stmt_bind_result($stmt, $logon, $hashed, $userId);
                         /* fetch value */
                         mysqli_stmt_fetch($stmt);
                         if (password_verify($password, $hashed) && $login == $logon) {
                              echo $successMessage = 'User has been logged in - ' . $login;
                              session_unset();
                              $_SESSION['userId'] = $userId;
                              // redirect back to Home
                              header('Location: Home');
                         } else {
                              $isValid = false;
                              $errorMessage = 'Invalid Username or Password.';
                         }
                         /* close statement */
                         mysqli_stmt_close($stmt);
                    } else {
                         $isValid = false;
                         $errorMessage = 'Mysqli prepare error.';
                    }
               } else {
                    $isValid = false;
                    $errorMessage = 'Form was not valid.';
               }
          }
          ?>
          <div class="container">
               <div class="card">
                    <div class="card-block">
                         <!--<h3>Debug session</h3>
                         <pre><?php //print_r($_SESSION);  ?></pre>-->
                         <form method="post">
                              <div class="form-group">
                                   <label for="Login">Login</label>
                                   <input type="text" name="Login" id="Login" value="<?= $login ?>" class="form-control col" required>
                              </div>
                              <div class="form-group">
                                   <label for="Password">Password</label>
                                   <input type="password" name="Password" id="Password" value="<?= $password ?>" class="form-control col" required>
                              </div>
                              <?php if ($isValid == false) { ?>
                                   <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <p><?= $errorMessage ?></p>
                                   </div>
                              <?php } ?>
                              <div class="form-group">
                                   <button type="submit" name="loginUserSubmit" class="btn btn-lg btn-primary col">Submit</button>
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
