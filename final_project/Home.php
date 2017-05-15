<?php
require_once('Includes/Functions.php');
$title = "Home";
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
          <div class="container">
               <div class="row">
                    <div class="col">
                         <br>
                    </div>
               </div>
               <div class="row">
                    <div class="col text-center card" style="opacity: 0.9;">
                         <h1>Welcome to ScottDotM Web Development.</h1>
                    </div>
               </div>
               <div class="row">
                    <div class="col">
                         <br>
                    </div>
               </div>
               <div class="row">
                    <div class="col bg-primary text-center" style="padding:10px;">
                         <div style="color:white;">
                              <h3>Informative Website</h3>

                         </div>
                         <ul class="list-group">
                              <li class="list-group-item text-center">Inform the world, about your business, blog, or your personal website.</li>
                              <a href="Quote.php?OfferedServiceID=1"><img src="Assets/Images/web1.PNG" alt="" class="img-thumbnail"></a>
                         </ul>
                    </div>
                    <div class="col bg-warning text-center" style="padding:10px;">
                         
                              <h3>E-Commerce Website</h3>
                         
                         <ul class="list-group">
                              <li class="list-group-item text-center">Sell products, or allow others to do the same, on your website.</li>
                              <a href="Quote.php?OfferedServiceID=3"><img src="Assets/Images/web2.PNG" alt="" class="img-thumbnail"></a>
                         </ul>
                    </div>
               </div>
               <div class="row">
                    <div class="col bg-inverse text-center" style="padding:10px;">
                         <div style="color:white;">
                              <h3>Update Existing Website</h3>
                         </div>
                         <ul class="list-group">
                              <li class="list-group-item text-center">Update an existing website.</li>
                              <a href="Quote.php?OfferedServiceID=5"><img src="Assets/Images/web3.PNG" alt="" class="img-thumbnail"></a>
                         </ul>
                    </div>
<!--                    <div class="col bg-warning text-center" style="padding:10px;">
                              <h3>Full Web Application</h3>
                         <ul class="list-group">
                              <li class="list-group-item text-center">Sell products, or allow others to do the same, on your website.</li>
                              <a href="Quote.php?OfferedServiceID=3"><img src="Assets/Images/web1.PNG" alt="" class="img-thumbnail"></a>
                         </ul>
                    </div>-->
               </div>
          </div>
          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
