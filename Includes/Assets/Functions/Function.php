<?php

/**
 * Description of Session
 *
 * @author Scott Muth <scottdotm.com>
 */
// function to get the values from the form
// '' is the value for $default if one is not provided
function formVal($fieldName, $default = '') {
     // get the page the function was called on
     $page = $_SERVER['PHP_SELF'];
     // check if there is value in $_POST, then $_GET
     if (isset($_POST[$fieldName])) {
          $value = $_POST[$fieldName];
     } else if (isset($_GET[$fieldName])) {
          $value = $_GET[$fieldName];
     } else if (isset($_SESSION[$page][$fieldName])) {
          $value = $_SESSION[$page][$fieldName];
     } else {
          $value = $default;
     }
     // store the value in the session for later use
     $_SESSION[$page][$fieldName] = $value;
     return $value;
}