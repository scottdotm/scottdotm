<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <title>Class Room 2/20/2017</title>
    </head>
    
    <body>
        <div class="container">
            <?php
            $questions = array(
                array('questionLabel' => 'First Video Game?', 'answer' => 'B', $possible = array('Mario', 'Pong', 'Chess', 'Lament')),
                array('questionLabel' => 'First MMO?', 'answer' => 'D', $possible = array('Runescape', 'World of Warcraft', 'Black Desert', 'Ultima Online')),
            );
            $possiblitites = array('A', 'B', 'C', 'D');

            foreach ($questions as $i => $question) {
                echo "<div class='card'><div class='card-block'>";
                echo "<h2 class='card-title'>" . " " . $question['questionLabel'] . "</h2>";
                echo "<div class='btn-group' data-toggle='buttons'>";
                echo $question['answer'] . "<br>";

                foreach ($possiblitites as $i => $poss) {
                    echo "<label class='btn btn-primary'>";
                    echo "<br><input type='radio' name='option' id='" . $possible[$i] . "' autocomplete='off'>" . $possiblitites[$i];
                    echo "</label>";
                }
                echo "</div></div></div>";
            }
            ?>

            <h1>WHAT IS GOING ON</H1>


            <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>

