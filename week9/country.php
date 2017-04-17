<?php
require_once('Includes/world.db.php');

$customerID = isset($_GET['code']) ? $_GET['code']:'USA';

$sql = "SELECT * \n"
        . "FROM Country \n"
        . "LEFT JOIN CountryLanguage ON Country.Code = CountryLanguage.CountryCode \n"
        . "WHERE Code = '$customerID' \n"
        . "ORDER BY Percentage DESC \n"
        . "LIMIT 1";
        
$results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

$product = mysqli_fetch_array($results);


?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <h1><?= $product['Name'] ?></h1>
        <p><?= $product['Name'] ?> is located in <?= $product['Region'] ?> and is home to <?= $product['Population'] ?> people...
         and who primarily speak <?= $product['Language'] ?></p>
        
        <h3>Cities</h3>
        <?php
        $sql = "SELECT * \n"
                . "FROM City \n"
                . "WHERE CountryCode = '$customerID' \n"
                . "ORDER BY Name";
        
        $results = mysqli_query($db, $sql) or die("Error in query: ". mysqli_error($db));
        
        if(mysqli_num_rows($results)){
            echo '<ul>';
            while($row=mysqli_fetch_array($results)){
                echo'<li>'.$row['Name'].'</li>';
            }
            echo '</ul>';
        }else{
            echo '<p> No Cities found. </p>';
            
        }
        mysqli_close($db);
        
        ?>
    </body>
</html>
