<!DOCTYPE html>
<!-- 
/**
 * Description of Knowledge
 * http://smuth4.bitlampsites.com/php1/ScottDotM/quiz_site/Index.php
 * @author Scott Muth <scottdotm.com>
 */
-->
<html>
     <?php
     require('Includes/Header.html.php');
     ?>
     <body>
          <?php
          $pagename = basename(__FILE__, '.php'); 
          require('Includes/Navbar.php');
          ?>
          <div class="jumbotron" style="padding-top: 100px;">
               <div class="row">
                    <p class="display-3">
                         Welcome to the History of Video Gaming
                    </p>
               </div>
               <div class="row">
                    <div class="col">
                         <p class="lead">
                              This site will give you a better understanding of
                              the history of video gaming.
                         </p>
                    </div>
                    <div class="col">
                         <p class="lead">
                              The site provides an informative Youtube video on the
                              Knowledge page. As well as a quiz on the information
                              gathered from the Youtube video.
                              <br>
                              <a href="https://www.youtube.com/watch?v=-I73oK9q-jk">Youtube Video Link</a>
                              <br>
                         </p>
                    </div>
                    <div class="col">
                         <p class="lead">
                              Site was created by Scott Muth as apart of the
                              web development PHP 1 course at WCTC.
                              <br>
                              <br>
                              March of 2017
                         </p>
                    </div>
               </div>
          </div>
          <section id="imgCarousel">
               <div class="row">
                    <div id="imgCarouselIndicators" class="carousel slide" data-interval="5000" data-ride="carousel" style="margin:auto;">
                         <ol class="carousel-indicators">
                              <li data-target="#imgCarouselIndicators" data-slide-to="0" class="active"></li>
                              <li data-target="#imgCarouselIndicators" data-slide-to="1"></li>
                              <li data-target="#imgCarouselIndicators" data-slide-to="2"></li>
                         </ol>
                         <div class="carousel-inner" role="listbox">
                              <div class="carousel-item active">
                                   <img class="d-block img-fluid" src="Assets/Images/children-593313_1280.jpg" alt="First slide">
                                   <div class="carousel-caption d-none d-md-block">
                                   </div>
                              </div>
                              <div class="carousel-item">
                                   <img class="d-block img-fluid" src="Assets/Images/mario-1557240_1280.jpg" alt="Second slide">
                                   <div class="carousel-caption d-none d-md-block">
                                   </div>
                              </div>
                              <div class="carousel-item">
                                   <img class="d-block img-fluid" src="Assets/Images/video-game-1332694_1280.png" alt="Third slide">
                                   <div class="carousel-caption d-none d-md-block">
                                   </div>
                              </div>
                         </div>
                         <a class="carousel-control-prev" href="#imgCarouselIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                         </a>
                         <a class="carousel-control-next" href="#imgCarouselIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                         </a>
                    </div>
               </div>
          </section>
          <?php
          require('Includes/Footer.html.php');
          require('Includes/Scripts.php');
          ?>
     </body>
</html>
<?php
/**
 * Description of Index
 * Homepage for application
 *
 * @author Scott Muth <scottdotm.com>
 */