<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <title>ARRays</title>
    </head>
    <body>
        <?php
        $games = array('Black Desert', 'Conan', 'World of Warships', 'Star Citizen');
        
        $games[] = 'Battlefield';
        
        array_splice($games, 2, 0, 'Mario');
        
        $apple = array('color'=>'red','name'=>'McIntosh','taste'=>'meh');
        
        $apple['weight'] = "10oz";  
        $tracks = array(
            100=>array('name' => 'Night Whitches', 'artist'=>'Sabaton', 'album'=>'Tenthousand Men'),
            array('name' => 'Fist in the Air', 'artist'=>'Five Finger', 'album'=>'kicking ass'),
        );
                $tracks[]=array('name'=>'Don\'t Fear the Reaper', 'artist'=>'Blue Oyster Cult', 'album' => 'albumName');
                
                
        ?>
        <h1 class="text-center">Arrays</h1>
        <div class="container">
        <?=$games[2];?> <br>
        
        <?php
        foreach($games as $game){
            echo "<div class='card'><div class='card-block'>";
            echo $game."<br>";
            echo "</div></div>";
        }
        echo "<br> Our Games: ".implode(" ,", $games)." <br>";
        echo '<br><br>';
        foreach($tracks as $i => $track){
            echo "<div class='card'><div class='card-block'>";
            echo "<h2 class='card-title'>".$i." ".$track['name']."</h2>";
            echo $track['artist']."<br>";
            echo $track['album'];
            echo "</div></div>";
        }
        echo $apple['taste'];
        ?>
        </div>


        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>
