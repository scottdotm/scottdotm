<?php

/**
 * THIS FILE SHOULD NOT BE PUBLICLY AVALIBLE.
 * Description of DB
 * create database connection
 * @author Scott Muth <scottdotm.com>
 */

//   				server      , username  , password , database
$db = mysqli_connect('localhost:3306', 'scott_DotM', 'Jn9v5*f2', 'scottdot_mysqlScottDotM') or die("Unable to connect to database". mysqli_connect_error() . PHP_EOL);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
