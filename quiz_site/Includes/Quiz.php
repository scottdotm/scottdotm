<?php

/**
 * Description of Quiz
 *   Quiz, validation of quiz, and quiz output.
 * @author Scott Muth <scottdotm.com>
 */
$questions = array(
    array('questionLabel' => 'What was the first video game ever made?', 'answer' => 'Pong', 'possible' => array('Mario', 'Pong', 'Chess', 'Lament')),
    array('questionLabel' => 'Who created the first video game and console?', 'answer' => 'Ralph Baer', 'possible' => array('Robert Kahn', 'Ralph Baer', 'Nolan Bushnell', 'Sir Timothy John Berners-Lee')),
    array('questionLabel' => 'What was the original name of the first video game console?', 'answer' => 'The All Purpose Box', 'possible' => array('Computer', 'Atari Game System', 'Magnavox Odyssey', 'The All Purpose Box')),
    array('questionLabel' => 'What job did the creator of the first video game have, besides inventor?', 'answer' => 'Defence Contractor', 'possible' => array('Electrical Engineer', 'Defence Contractor', 'Programmer', 'Plumber')),
    array('questionLabel' => 'What media was the first video game stored on?', 'answer' => 'Programmed Cards', 'possible' => array('Programmed Cards', 'Laserdisc', 'Punched Tape', 'Floppy Disc'))
);
foreach ($questions as $i => $question) {
     $quesL = $question['questionLabel'];
     echo "<div class='card'><div class='card-block'>";
     echo "<h2 class='card-title'>" . " " . $quesL . "</h2>";
     echo "<div class='btn-group' data-toggle='buttons'>";

     foreach ($question['possible'] as $x => $possible) {
          echo "<label for='" . $quesL . "' class='btn btn-primary btn-lrg'>";
          echo "<input type='radio' name='" . $quesL . "' id='" . $possible . "'value='". $possible;
//          $c = str_replace(" ", "_", $quesL);
//          $s = filter_input(INPUT_POST, $c, FILTER_SANITIZE_STRING);
//          if(isset($s)==$possible){
//               echo ' checked'; 
//          }
          echo "' autocomplete='off'>" . $possible;
          echo "</label>";
     }
     echo "</div></div></div>";
}

$_submit = filter_input(INPUT_POST, "submit", FILTER_SANITIZE_STRING);
if (isset($_submit)) {
     
     foreach ($questions as $i => $question) {
          $quesL = $question['questionLabel'];
          if (empty($quesL)) {
               $isValid = false;
          }
          $_checked = str_replace(" ", "_", $quesL);
          $checked = stripslashes($_checked);
          $solution = filter_input(INPUT_POST, $checked, FILTER_SANITIZE_STRING);
          if (empty($solution)||$solution=="") {
               $isValid = false;
          }
          echo "<div class='card'><div class='card-block'>";
          if ($isValid) {
               
               echo "<h4 class='card-title'>".$quesL . "</h4>";
               if ($solution == $question['answer']) {
                    echo "<p class='card-text'> Correct </p>";
                    echo "Selected : ".$solution;
                    $counterCorrect++;
               } else {
                    echo "<p class='card-text'> Incorrect </p>";
                    echo "Selected : ".$solution;
                    $counterIncorrect++;
               }
               // calculate the percentage based on the number correct out of the total number of questions
          } else {
               echo("<div class='alert alert-danger'><h4>Please complete all questions</h4></div>");
               echo "</div> </div>";
               break;
          }
          echo "</div> </div>";
     }
     if ($isValid) {
          echo percentCorrect($counterCorrect, $counterIncorrect);
     }
}