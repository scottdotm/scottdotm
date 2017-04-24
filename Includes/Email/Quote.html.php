<!-- Zinc Inc Email Quote HTML -->
<div class="container-fluid">
     <h1>
          <button style="padding:25px;" id="requestQuote" class="btn btn-info btn-lg col"> Request Quote</button>
     </h1>
     <?php
     require('Email.php');
     ?>
     <form id="quote" name="quote" method="POST" action="" enctype="multipart/form-data">
          <hr>
          <div class="row">
               <h1 class="col">
                    Email Contact Form
               </h1>
               <!--                              <div class="col">
                                                  <div class="text-right col" style="padding:5px;">
                                                       <button type="button" target="#requestQuote" id="closeQuote1" class="btn btn-danger btn-lg col"><i id="close" class="fa fa-2x fa-window-close" aria-hidden="true"></i></button>
                                                  </div>
                                             </div>-->
          </div>
          <div class="row">
               <div class="col">
                    <p class="lead">Feel free to use this form to contact ScottDotM.</p>
               </div>
          </div>
          <div class="row">
               <div class="form-group col">
                    <label class="col-2 col-form-label" for='fromemail'>Email:</label>
                    <div class="col-12 input-group margin-bottom-sm">
                         <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                         <input type='email' class="form-control" id="fromemail" name="fromemail" value="" placeholder="Email" required>
                         <p>
                              <?php
                              if (!$isValid) {
                                   echo$fromEmailError;
                              }
                              ?>
                         </p>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="form-group col">

                    <label class="col-form-label" for='firstname'>First Name:</label>
                    <div class="">
                         <input type='text' class="form-control" id="firstname" name="firstname" value="" placeholder="First Name">
                    </div>
                    <p>
                         <?php
                         if (!$isValid) {
                              echo $firstLastSubjectError;
                         }
                         ?>
                    </p>
               </div>
               <div class="form-group col">
                    <label class="col-form-label" for='lastname'>Last Name:</label>
                    <div class="">
                         <input type='text' class="form-control" id="lastname" name="lastname" value="" placeholder="Last Name">
                    </div>
                    <p>
                         <?php
                         if (!$isValid) {
                              echo $firstLastSubjectError;
                         }
                         ?>
                    </p>

               </div>
          </div>
          <div class="row">
               <div class="form-group col">
                    <label class="col-form-label" for='subject'>Subject</label>
                    <div class="">
                         <input class="form-control" name='subject' value='' id='subject' placeholder='Subject' required>
                    </div>
                    <p>
                         <?php
                         if (!$isValid) {
                              echo $firstLastSubjectError;
                         }
                         ?>
                    </p>
               </div>
          </div>
          <div class="row">
               <div class="form-group col">
                    <label class="col-form-label" for='bodytext'>Body</label>
                    <div class="">
                         <textarea class="form-control" rows="7" name='bodytext' id='bodytext' required></textarea>
                    </div>
               </div>
          </div>
          <div class="row">
               <button type="submit" name="submit" value="Submit" class="btn btn-success btn-lg col">Submit <i class="fa fa-mail-forward fa-1x"></i></button>
               <!--                         <div class="col-3">
                                        </div>-->
               <!--                         <div class="text-right" style="padding:5px;">
                                             <button type="button" target="#requestQuote" id="closeQuote2" class="btn btn-danger btn-lg col"><i id="close" class="fa fa-2x fa-window-close" aria-hidden="true"></i></button>
                                        </div>-->
          </div>
     </form>
     <?php
     if (isset($_submit)) {
          ?>

          <div class="card">
               <?php
               echo $fromEmail . $firstName . $lastName . $subject . $bodyText
               ?>
          </div>
          <?php
     }
     ?>
</div>
