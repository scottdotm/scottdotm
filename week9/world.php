<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="Scott Muth">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.min.css"/>
    </head>
    <body>
        <?php
        // Week 9 : World database connection
        require('Includes/world.db.php');
        $sort=isset($_GET['sort']) ? $_GET['sort'] : 'Name';
        $dir = isset($_GET['dir']) ? $_GET['dir'] : 'ASC';
        //create query, ALWAYS use double quotes
        $sql = "SELECT Code, Name, Continent, Population\n"
                . "FROM `Country`\n"
                . "WHERE Population > 0\n"
                . "ORDER BY $sort $dir";

        //or
        $sql = "SELECT Code, Name, Continent, Population FROM `Country` WHERE Population > 0 ORDER BY $sort $dir";

        //execute query
        // $result is just a REFERANCE to the database result
        $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
        ?>

        <div class="container">
            <h1 class="text-center">Testing Database Front-end style.</h1>
            <?php
            echo"<p>Total Countries: " . mysqli_num_rows($results) . "</p>";
            ?>
            <div class="row">
                <table class="table tabel-bordered table-hover table-inverse">
                    <thead>
                        <tr>
                            <th><a href="?sort=Code">Code</a></th>
                            <th><a href="?sort=Name&dir=<?=($sort=="Name" and $dir == "ASC") ? "DESC" : "ASC" ?>">Name</a></th>
                            <th><a href="?sort=Continent&dir=<?=($sort=="Continent" and $dir == "ASC") ? "DESC" : "ASC" ?>">Continent</a></th>
                            <th><a href="?sort=Population&dir=<?=($sort=="Population" and $dir == "ASC") ? "DESC" : "ASC" ?>">Population</a></th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        //output results
                        //loop while we have rows
                        while ($row = mysqli_fetch_array($results)) {
                            //$row is one record from the database
                            //$row only contains the columns you "SELECT"ed
                            echo "<tr>"
                            . "<th scope='row'>" . $row['Code'] . "</th>";
                            echo "<td><a href='country.php?code=". $row['Code']."'>" . $row['Name'] . "</a></td>";
                            echo "<td>" . $row['Continent'] . "</td>";
                            echo "<td>" . $row['Population'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        //close database connection (maybe in your footer)
        mysqli_close($db);
        ?>


        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>
