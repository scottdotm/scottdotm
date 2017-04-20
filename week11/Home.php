<!DOCTYPE html>
<!-- 
/**
 * Description of Index
 * Homepage
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <?php
     require('Includes/Header.html');
     ?>
     <body class="backgroundImage">
          <?php
          $pagename = basename(__FILE__, '.php');
          require('Includes/Navbar.html.php');
          ?>
          <div class='FerroFont text-center' style="font-size: 250px;">Northwind</div>
          <canvas id="cvs">
               <?php
               require('Includes/Footer.html');
               ?>
          </canvas>
     </body>
</html>
