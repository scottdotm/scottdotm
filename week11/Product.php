<?php
require_once('Includes/Northwind.DB.php');

$productID = isset($_GET['ProductID']) ? $_GET['ProductID'] : '1';

$sql = "SELECT p.ProductID, p.ProductName, s.CompanyName, c.CategoryName, p.QuantityPerUnit, p.UnitPrice, p.UnitsInStock, p.UnitsOnOrder
FROM products AS p
JOIN suppliers AS s ON p.SupplierID = s.SupplierID
JOIN categories AS c ON p.CategoryID = c.CategoryID
WHERE ProductID = '$productID'
ORDER BY ProductName DESC
LIMIT 1";

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
     <?php
     require('Includes/Header.html');
     ?>
     <body>
          <?php
          require('Includes/Navbar.html');
          ?>
          <div class="container">
               <div class="card">
                    <h1 class="card-title FerroFont text-center" style="font-size: 150px;">Product Information</h1>
                    <div class="card-block">
                         <div class="row">
                              <div class="col">
                                   <label>Product ID</label>
                                   <p class="lead"><?= $product['ProductID'] ?></p>
                              </div>

                              <div class="col">
                                   <label>Product Name</label>
                                   <p class="lead"><?= $product['ProductName'] ?></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label>Supplier Name</label>
                                   <p class="lead"><?= $product['CompanyName'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Category Name</label>
                                   <p class="lead"><?= $product['CategoryName'] ?></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label>Quantity Per Unit</label>
                                   <p class="lead"><?= $product['QuantityPerUnit'] ?></p>
                              </div>

                              <div class="col">
                                   <label>Unit Price</label>
                                   <p class="lead"><?= $product['UnitPrice'] ?></p>
                              </div>

                              <div class="col">
                                   <label>Units in Stock</label>
                                   <p class="lead"><?= $product['UnitsInStock'] ?></p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <?php
          require('Includes/Footer.html');
          ?>
     </body>
</html>
