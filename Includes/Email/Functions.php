<?php
/**
 * Description of Functions
 * Custom Functions
 * @author Scott Muth <scottdotm.com>
 */
function removeWhiteSpace ($_string){
     $string = preg_replace('/\s+/', '', $_string);
     return $string;
}
function FilterInputPostString($string){
     $FIPString=filter_input(INPUT_POST, $string, FILTER_SANITIZE_STRING);
     return $FIPString;
}
function FilterValidateEmail($email){
     $fVEmail = filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL);
     return $fVEmail;
}

