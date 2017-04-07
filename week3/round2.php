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
        
        ?>
        <form method="post">
            <h3>New Track </h3>
            <label>Name: <input type="text" name="track[name]"></label>
            <label>Artist: <input type="text" name="track[artist]"></label>
            <label>Album: <input type="text" name="track[album]"></label>
            
            <h2>Genres:</h2>
            <label><input type="checkbox" name="track[genres][]" value="rock">Rock</label><br>
            <label><input type="checkbox" name="track[genres][]" value="blues">Blues</label><br>
            <label><input type="checkbox" name="track[genres][]" value="rap">Rap</label><br>
            
            <input type="submit" name="submit" value="Submit">
        </form>
        
        <?php
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
        if(isset($_POST['submit'])){
            $track = $_POST['track'];
            echo "Track Name: {$track['name']}<br>";
            echo "Track Genres: ".(isset($track['genres']) ? implode(", ", $track['genres']) : '');
        }
        ?>
    </body>
</html>
