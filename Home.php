<?php
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
          ?>
          <!--                         <h3>Debug session</h3>
                         <pre><?php //print_r($_SESSION); ?></pre>-->
          <div class='container-fluid'>
               <div class='row'>
               <h3 class='col'>Thanks for stopping by! We're currently working on things, Feel free to come back after we kick start this website.</h3>
               </div>
          </div>
          <?php
          require_once('Includes/HTML/Footer.php');
          ?>
     </body>
</html>
