<?php

/**
 * Description of Validation
 * Email Validation
 * @author Scott Muth <scottdotm.com>
 */
function ValidateString($string, $length) {
     if (strlen($string) < $length || empty($string)) {
          $isValid = false;
          $firstLastSubjectError = ('String is not valid.');
     } else {
          $isValid = true;
     }
     return $isValid;
}

function ValidateEmail($email, $length) {
     if (strlen($email) < $length || empty($email)) {
          $isValid = false;
          ('Email is not valid.');
     } else {
          $isValid = true;
     }
     return $isValid;
}

function CheckFile($uploadFile, $maxSize, $types) {
     if (filesize($uploadFile) < $maxSize && in_array(mime_content_type($uploadFile), $types)) {
          $isValid = true;
          throw new FileException('File is too large, or does not use supported extention. <br>'
          . '<br> Upload Size : '
          . mime_content_type($uploadFile)
          . '<br> Extention : '
          . filesize($uploadFile)
          );
     } else {
          $isValid = false;
     }
     return $isValid;
}
