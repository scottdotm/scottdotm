<!DOCTYPE html>
<!-- 
/**
 * Description of Knowledge
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <?php
     require('Includes/Header.html.php');
     ?>
     <body>
          <?php
          $pagename = basename(__FILE__, '.php');
          require('Includes/Navbar.php');
          ?>
          <div class="jumbotron" style="padding-top: 100px;">
               <p class="display-3">
                    Knowledge
               </p>
               <p class='lead'>
                    This section will give you a good background of the history
                    of video games and the creator of video games.
               </p>
          </div>
          <div class="container">
               <div class="row">
                    <div class="col">
                         <div class="card">
                              <div class="card-block">
                                   <p class="display-4">
                                        This is the Youtube video regarding the 
                                        the creation of the first video game console.
                                   </p>
                              </div>
                         </div>
                    </div>
               </div>
               <center><iframe width="1000" height="600" src="https://www.youtube.com/embed/-I73oK9q-jk" frameborder="0" allowfullscreen></iframe></center>
          </div>
          <br>
          <br>
          <div class="container">

               <div class="row col">
                    <div class="card">
                         <div class="card-block">
                              <p class="lead">
                              Bellow are some pieces of information from the video.
                              </p>
                              <br>
                              <ul class="list-group">
                                   <li class="list-group-item">Nolan Bushnell created Atari.</li>
                                   <li class="list-group-item">Ralph Baer created the first video game console.</li>
                                   <li class="list-group-item">Baer's patents are held by the security contractor he worked for.</li>
                                   <li class="list-group-item">Now known as the 'Brown Box' the first video game console was named originally, the 'All Purpose Box'</li>
                                   <li class="list-group-item">While with other titles such as Tennis, the game itself was essentially pong.</li>
                                   <li class="list-group-item">The first video game created was wrote using programmed cards</li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
          <br>
          <br>
          
          <?php
          require('Includes/Footer.html.php');
          require('Includes/Scripts.php');
          ?>
     </body>
</html>