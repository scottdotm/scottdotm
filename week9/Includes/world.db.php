<?php

/* 
 * Our database connection.
 * 
 *                  Server,     username,   password,   database
 */

$db = @mysqli_connect('localhost', 'smuth4', '000434994', 'world') or 
        die("Unable to connect to database.");
        

