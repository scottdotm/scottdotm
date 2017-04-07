<!DOCTYPE html>
<!--
Redistribution and use in source and binary forms, with or without
modification, is permitted provided that the following conditions
are met:

  1. Redistributions of source code must retain the above copyright
     notice, this list of conditions and the following disclaimer.
 
  2. Redistributions in binary form must reproduce the above copyright
     notice, this list of conditions and the following disclaimer in
     the documentation and/or other materials provided with the
     distribution.
 
  3. The name "PHP" must not be used to endorse or promote products
     derived from this software without prior written permission. For
     written permission, please contact group@php.net.
  
  4. Products derived from this software may not be called "PHP", nor
     may "PHP" appear in their name, without prior written permission
     from group@php.net.  You may indicate that your software works in
     conjunction with PHP by saying "Foo for PHP" instead of calling
     it "PHP Foo" or "phpfoo"
 
  5. The PHP Group may publish revised and/or new versions of the
     license from time to time. Each version will be given a
     distinguishing version number.
     Once covered code has been published under a particular version
     of the license, you may always continue to use it under the terms
     of that version. You may also choose to use such covered code
     under the terms of any subsequent version of the license
     published by the PHP Group. No one other than the PHP Group has
     the right to modify the terms applicable to covered code created
     under this License.

  6. Redistributions of any form whatsoever must retain the following
     acknowledgment:
     "This product includes PHP, freely available from
     <http://www.php.net/>".
THIS SOFTWARE IS PROVIDED BY THE PHP DEVELOPMENT TEAM ``AS IS'' AND 
ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A 
PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE PHP
DEVELOPMENT TEAM OR ITS CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES 
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR 
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
OF THE POSSIBILITY OF SUCH DAMAGE.

-------------------------------------------------------------------- 

This software consists of voluntary contributions made by many
individuals on behalf of the PHP Group.

The PHP Group can be contacted via Email at group@php.net.

For more information on the PHP Group and the PHP project, 
please see <http://www.php.net>.

This product includes the Zend Engine, freely available at
<http://www.zend.com>. 
-->
<!-- 
/**
 * Description of RicksDesks
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <title>Rick's Desks</title>
          <meta charset="utf-8">
          <meta name="keywords" content="DESK, DESK, DEEEEEESSSSKKKKKKSSSSSSS!">
          <meta name="description" content="Rick Hammers Desks">
          <meta name="author" content="Scott Muth">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
          <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.min.css"/>
     </head>
     <body>
          <?php
          // put your code here
          // filter post
          //Dump Data sent by Form
          echo '<pre>';
          var_dump(filter_input_array(INPUT_POST)); // or print_r //r stands for recurssive 
          echo '</pre>';

          $wood = '';
          $lenError = '';
          $widthError = '';
          $drawerError = '';
          $fillOutForm = '';
          $price = 0;

          if (isset($_POST['submit'])) {
               $length = $_POST['length'];
               $width = $_POST['width'];
               $drawerNum = $_POST['drawerNum'];
               $wood = isset($_POST['wood']) ? $_POST['wood'] : '';
               $isValid = true;

               if (!is_numeric($length)) {
                    $isValid = false;
                    $lenError = "Length Error";
               }
               if (!is_numeric($width)) {
                    $isValid = false;
                    $widthError = "Width Error";
               }
               if (!is_numeric($drawerNum)) {
                    $isValid = false;
                    $drawerError = "Drawer Number Error";
               }
               if ($isValid) {
                    //area of desk
                    $area = $length * $width;

                    $drawerPrice = $drawerNum * 30;
                    $base = 200 + $drawerPrice;

                    if ($wood == "Mahogany") {
                         $price = $base + 150;
                    }
                    if ($wood == 'Oak') {
                         $price = $base + 125;
                    }
                    if ($wood == 'Pine') {
                         $price = $base;
                    }



                    if (750 < $area) {
                         $price = $base + 50;
                    }
               } else {
                    $fillOutForm = "<h1>Please complete all fields.</h1>";
               }
          }
          ?>
          <div class='container'>
               <h1 class="text-center">Rick's Desks - Just ask me about my desks.</h1>
               <center>
               <?php if (!isset($_POST['submit'])or ! $isValid): ?>
                    <h1><span class="text-danger"><?= $fillOutForm ?></span></h1>
                    <div class="card">
                         <div class="card-block">
                              <form method='post' name="form1" id="form1" action="">
                                   <div class="form-group">
                                        <label>Length</label>
                                        <input type="number" name="length" placeholder="Length"><span class="text-danger"><?= $lenError ?></span>
                                   </div>
                                   <div class="form-group">
                                        <label>Width</label>
                                        <input type="number" name="width" placeholder="Width"><span class="text-danger"><?= $widthError ?></span>
                                   </div>
                                   <div class="form-group">
                                        <label>Drawers</label>
                                        <input type="number" name="drawerNum" placeholder="Number of Drawers"><span class="text-danger"><?= $drawerError ?></span>
                                   </div>
                                   <div class="form-group">
                                        <div class="radio">
                                             <label><input type="radio" value="Mahogany" id="wood1" name="wood" <?= $wood == "Mahogany" ? 'checked' : ' ' ?> >Mahogany</label>
                                        </div>
                                        <div class="radio">
                                             <label><input type="radio" value='Oak' id="wood2" name="wood" <?= $wood == 'Oak' ? 'checked' : ' ' ?> >Oak</label>
                                        </div>
                                        <div class="radio">
                                             <label><input type="radio" value='Pine' id="wood3" name="wood" <?= $wood == 'Pine' ? 'checked' : ' ' ?> >Pine</label>
                                        </div>
                                   </div>
                                   <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                              </form>
                         </div>
                    </div>
               <?php endif ?>
               <?php if (isset($_POST['submit']) && $isValid): ?>
                    <table class="table tabel-bordered table-hover table-inverse">
                         <!--                    echo $length . " " . "<br>";
                    echo $width . " " . "<br>";
                    echo $drawerNum . " " . "<br>";
                    echo $wood . " " . "<br>";

                    echo $price . " " . "<br>";-->
                         <thead>
                              <tr>
                                   <th>#</th>
                                   <th>Length</th>
                                   <th>Width</th>
                                   <th>Number of Drawers</th>
                                   <th>Wood Type</th>
                                   <th>Price</th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   <th scope="row">1</th>
                                   <td scope="row"><?= $length ?></td>
                                   <td scope="row"><?= $width ?></td>
                                   <td scope="row"><?= $drawerNum ?></td>
                                   <td scope="row"><?= $wood ?></td>
                                   <td scope="row"><?= $price ?></td>
                              </tr>
                              <tr>
                                   <th scope="row">2</th>
                                   <td scope="row"><?= $length ?></td>
                                   <td scope="row"><?= $width ?></td>
                                   <td scope="row"><?= $drawerNum ?></td>
                                   <td scope="row"><?= $wood ?></td>
                                   <td scope="row"><?= $price ?></td>
                              </tr>
                              <tr>
                                   <th scope="row">3</th>
                                   <td scope="row"><?= $length ?></td>
                                   <td scope="row"><?= $width ?></td>
                                   <td scope="row"><?= $drawerNum ?></td>
                                   <td scope="row"><?= $wood ?></td>
                                   <td scope="row"><?= $price ?></td>
                              </tr>
                         </tbody>
                    </table>
                    <h3>Thank you for your order, have a wonderful day.</h3>
               <?php endif ?>
               </center>
          </div>  

          <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
     </body>
</html>
