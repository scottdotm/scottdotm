<!DOCTYPE html>
<!-- 
/**
 * Description of Knowledge
 *
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
          <section id="body" class="container-fluid" style="padding-top: 100px;">
               <div class="jumbotron">
               <div class="row">
                    <p class="display-3">
                         Quiz
                    </p>
               </div>
               <div class="row">
                    <p class="lead">
                         This is a quiz from all the information gathered from watching
                         the Youtube video in the Knowledge section. Once taken, click
                         the submit button on the bottom of the form, then navigate to
                         the bottom on the page to see your score.
                    </p>
               </div>
               </div>
               <form method='post' name="form1" id="form1" action="">
                    <?php
                    require('Includes/Functions.php');
                    ?>
                    <?php
                    require('Includes/Quiz.php');
                    ?>
                    <div class="row">
                         <div class="col">
                              <div class="row" style="padding:20px;">
                                   <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg col-12">Submit</button>
                              </div>
                         </div>
                    </div>
               </form>
          </section>
          <?php
          require('Includes/Footer.html.php');
          require('Includes/Scripts.php');
          ?>
     </body>
</html>