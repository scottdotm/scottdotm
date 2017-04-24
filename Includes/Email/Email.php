<?php

/**
 * Description of Email
 * Uses PHPMailer to send Email's.
 * TO DO - ATTACHMENTS
 *
 * @author Scott Muth <scottdotm.com>
 */
//Turn on errors REMOVE FOR PRODUCTION
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
include('Functions.php');
include('Validation.php');


//pull in as webmaster
$destinationEmail = 'scott@scottdotm.com';
$webMasterName = 'ScottDotM';
$_submit = filter_input(INPUT_POST, "submit");

if (isset($_submit)) {
     $isValid = true;
     try{
     $fromEmail = ValidateEmail($_POST['fromemail'],4);
     } catch(EmailException $eE){
          $fromEmailError=$eE->getMessage();
          
     }
     try{
     $firstName = ValidateString($_POST['firstname'],2);
     $lastName = ValidateString($_POST['lastname'],2);
     $subject = ValidateString($_POST['subject'],4);
     } catch (StringException $e){
          $firstLastSubjectError = $e->getMessage();
     }
     
     $bodyText = ValidateString($_POST['bodytext'],10);
     
}
