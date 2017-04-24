<!DOCTYPE html>
<!-- 
/**
 * Description of Index
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <?php
     require('Includes/Header.php');
     ?>
     <body>
          <?php
          // Navbar Include
          require('Includes/Navbar.php');
          ?>
          <div class="container-fluid">
               <div class="row">
                    <section class="greeting">
                         <p class="display-3 col">
                              Hello
                         </p>
                    </section>
               </div>
               <div class="row">
                    <section id ="missionStatement">
                         <p class="lead col">
                              My name is Scott, I am a web and software developer that has a passion for technology.
                              Building professional web applications for local and regional clients. I am not simply a website designer,
                              I am a developer.
                         </p>
                    </section>
               </div>
               <div class="row">
                    <section id="services">
                         <div class="row">
                              <div class="list-group">
                                   <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                             <h5 class="mb-1">Website creation.</h5>
                                             <small>3 days ago</small>
                                        </div>
                                        <hr>
                                        <p class="mb-1">
                                             I have experience creating websites for small organizations that have no dedicated IT team. I will use a hosting provider
                                             to host your website, and will also meet in person with the organization to gather requirements.
                                        </p>
                                        <hr>
                                        <small>Requirements : What do you want me to create? See added page for ideas/examples.</small>
                                   </a>
                                   <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                             <h5 class="mb-1">Ecommerce Website</h5>
                                             <small class="text-muted">3 days ago</small>
                                        </div>
                                        <hr>
                                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                        <hr>
                                        <small class="text-muted">Donec id elit non mi porta.</small>
                                   </a>
                                   <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                             <h5 class="mb-1">Web Applications</h5>
                                             <small class="text-muted">3 days ago</small>
                                        </div>
                                        <hr>
                                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                        <hr>
                                        <small class="text-muted">Donec id elit non mi porta.</small>
                                   </a>
                              </div>
                         </div>
                    </section>
               </div>
               <div class="col">
                    <div class="card">
                         <div class="card-block">
                   <?php
                    require('Includes/Email/Quote.html.php');
                    ?>
                         </div>
                    </div>
               </div>
          </div>
          <br>
          <br>
          <br>
          <?php
          // Footer Includes
          require('Includes/Footer.php');
          ?>
          
          <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
          <script src="Assets/JS/customJavaScript.js" type="text/javascript"></script>
     </body>
</html>
