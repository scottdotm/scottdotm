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
        $months = array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        echo "<h1>Index Array of Months</h1>";
        foreach ($months as $month) {
            echo $month . ", ";
        }
        asort($months);
        echo "<br><br>";
        echo "<h1>A-Z Sort</h1>";
        foreach ($months as $month) {
            echo $month . ", ";
        }
        ?>
    </body>
</html>
