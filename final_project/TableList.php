<?php
	require_once('Includes/Functions.php');
        $title="Table List";
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
          <table class="table table-hover table-inverse bg-primary">
               <thead>
                    <tr>
                         <th>#</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Username</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <th scope="row">1</th>
                         <td>Mark</td>
                         <td>Otto</td>
                         <td>@mdo</td>
                    </tr>
               </tbody>
          </table>
          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
