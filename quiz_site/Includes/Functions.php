<?php

/**
 * Description of functions
 *   Quiz Functions
 * @author Scott Muth <scottdotm.com>
 */

$counterCorrect = 0;
$counterIncorrect = 0;
$isValid = true;

function percentCorrect($cor, $incor) {
     $total = $cor + $incor;
     if ($total == 0) {
          return "<div clas='alert alert-danger'>No questions answered or all questions are inncorrect, please try again.</div>";
     } else {
          $percent = ($cor / $total) * 100;
          return "<div class='container text-center'><div class='alert alert-info'><h4> Percent Correct : " . $percent . "</h4></div></div>";
     }
}

function check($value) {
     if (isset($_POST[$value]) and $_POST[$value] == $value) {
          echo ' checked';
     }
}
