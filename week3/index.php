<!DOCTYPE html>
<!-- 
/**
 * Description of index
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <title>Week 4 Homework</title>
          <meta name="keywords" content="Week 4 Homework">
          <meta name="description" content="Week 4 Homework">
          <meta name="author" content="Scott Muth">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
          <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.min.css"/>
     </head>
     <body>
          <?php
          // put your code here
          $vowelCounter = 0;
          $wordCounter = 0;
          $sentCount = 0;
          $strL = 0;
          $t = "";
          if (isset($_POST['submit'])) {
               $str = $_POST['para'];
               $words = explode(" ", $str);
               $sentences = explode(".", $str);
               $vowelWords;
               $replace = array(",", ".", "-", "(", ")", "'", "!", "?", "\"");
               $strFormated = str_replace($replace, "", $str);
               $strL = strlen($str);
               
               $t=explode(" ", $strFormated);
               sort($t);
               
               //Words - Characters - Vowel Words
               foreach ($words as $i => $word) {
                    //Vowel Words
                    $subStr = substr($word, 0, 1);
                    if ($subStr == "i" || $subStr == "I" || $subStr == "a" || $subStr == "A" || $subStr == "e" || $subStr == "E" || $subStr == "o" || $subStr == "O" || $subStr == "u" || $subStr == "U" || $subStr == "y" || $subStr == "Y") {
                         $vowelCounter++;
                         $vowelWords[] = $word;
                    }
                    $wordCounter++;
               }
               //Sentances
               foreach ($sentences as $i => $sent) {
                    $sentCount = $i;
               }
          }
          ?>

          <div class="container">
               <div class="jumbotron">
               <div class="row">
               <h1 class="text-center">Formatification</h1>
               </div>
               <form method='post' name="form1" id="form1" action="">
                    <div class="form-group">
                         <label for="para">Paragraph:</label>
                         <textarea class="form-control" rows="5" name="para" id="para"></textarea>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
               </form>
               </div>

               
               <div class="row">
               <table class="table">
                    <thead class="thead-inverse">
                         <tr>
                              <th>Sentence Count</th>
                              <th>Word Count</th>
                              <th>Last Name</th>
                              <th>Character Count</th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr>
                              <td><?= $sentCount ?></td>
                              <td><?= $wordCounter ?></td>
                              <td><?= $strL ?></td>
                              <td><?= $vowelCounter ?></td>
                         </tr>
                    </tbody>
               </table>
               </div>
               <div class="row ">
               <table class="table">
                    <thead class="thead-inverse">
                         <tr>
                              <th>
                                   Lastly, lookup a string modifier to remove all punctuation and then output every word
                                   in alphabetical order.
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr>
                              <td>
                                   <div class="container">
                                   <?PHP
                                   if (isset($_POST['submit'])) {
                                        foreach ($t as $key => $val) {
                                             echo " ".$val;
                                        }
                                   }
                                   ?>
                                   </div>
                              </td>
                         </tr>
                    </tbody>
               </table>
               </div>
          </div>


          <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
     </body>
</html>
