<?php

/**
 * Description of Session
 *
 * @author Scott Muth <scottdotm.com>
 */
require_once('Includes/Functions.php');

// NEED to start the session BEFORE any ECHO or HTML
session_name('northwind_pagination'); // needs to come before session_start
session_start();

// add stuff to session
$_SESSION['username'] = 'northwind_user';

// get something from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;

// delete something from session
unset($_SESSION['username']);

// destroy whole session
//session_destroy();
