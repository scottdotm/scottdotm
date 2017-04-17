<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    require('Includes/Header.html');
    ?>
    <body>
        <?php
        // Northwind/Products database connection and Navbar
        require('Includes/Navbar.html');
        require('Includes/Northwind.DB.php');
        //Default sorting
        $sort=isset($_GET['sort']) ? $_GET['sort'] : 'ProductName';
        $dir = isset($_GET['dir']) ? $_GET['dir'] : 'ASC';
        //create query, ALWAYS use double quotes
        $sql = "SELECT p.ProductID, p.ProductName, s.CompanyName, c.CategoryName FROM `products` AS p JOIN categories AS c ON p.CategoryID = c.CategoryID JOIN suppliers AS s ON p.SupplierID = s.SupplierID ORDER BY $sort $dir";
                //. "ORDER BY $sort $dir";

        //execute query
        // $result is just a REFERANCE to the database result
        $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
        ?>
         <h1 class="FerroFont text-center" style="font-size: 150px;">Northwind Products</h1>
        <div class="container">
            
            <div class="row">
                <table class="table tabel-bordered table-hover table-inverse">
                    <thead>
                        <tr>
                            <th><a href="?sort=p.ProductName&dir=<?=($sort=="p.ProductName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Product Name</a></th>
                            <th><a href="?sort=s.CompanyName&dir=<?=($sort=="s.CompanyName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Company Name</a></th>
                            <th><a href="?sort=c.CategoryName&dir=<?=($sort=="c.CategoryName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Category Name</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //output results
                        //loop while we have rows
                        while ($row = mysqli_fetch_array($results)) {
                            //$row is one record from the database
                            //$row only contains the columns you "SELECT"ed
                            echo "<tr>";
                            echo "<td><a href='Product.php?ProductID=". $row['ProductID']."'>" . $row['ProductName'] . "</a></td>";
                            echo "<td>" . $row['CompanyName'] . "</td>";
                            echo "<td>" . $row['CategoryName'] . "</td>";
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
        <?php
        require('Includes/Footer.html');
        ?>
    </body>
</html>
