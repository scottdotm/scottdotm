<?php
	require_once('Includes/Functions.php');
        $title="Home";
	// NEED to start the session BEFORE any ECHO or HTML
	session_name('smuth4_final_project'); // needs to come before session_start
	session_start();

	// add stuff to session
	$_SESSION['username'] = 'smuth4';

	// get something from the session
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;

	// delete something from session
	unset($_SESSION['username']);

	// destroy whole session
	//session_destroy();
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
          <div class="container-fluid">
               <div class="row">
                    <div class="col bg-primary" style="padding-top:100px;">
                         <div style="color:white;">This is my card.</div>
                    </div>
                    <div class="col bg-warning" style="padding-top:100px;">
                         <div style="color:white;">This is my card.</div>
                    </div>
                    <div class="col bg-inverse" style="padding-top:100px;">
                         <div style="color:white;">This is my card.</div>
                    </div>
               </div>
          </div>
          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
