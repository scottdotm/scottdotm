<?php
require_once('Includes/Northwind.DB.php');

$customerID = isset($_GET['customerID']) ? $_GET['customerID'] : 'ROMEY';

$sql = "SELECT c.CustomerID, c.CompanyName, c.ContactName, c.ContactTitle, c.Address, c.City, c.PostalCode, c.Country, c.Phone, c.Fax\n"
        . "FROM customers AS c\n"
        . "WHERE CustomerID = '$customerID'\n"
        . "LIMIT 1";

$results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

$customer = mysqli_fetch_array($results);
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
          $pagename = basename(__FILE__, '.php'); 
          require('Includes/Navbar.html.php');
          ?>
          <div class="container">
               <div class="card">
                    <div class='card-title'>
                         <h1 class="col">
                              Customer Information
                         </h1>
                    </div>
                    <div class="card-block">
                         <div class="row">
                              <div class="col">
                                   <label>Company Name</label>
                                   <p class="lead"><?= $customer['CompanyName'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Contact Name</label>
                                   <p class="lead"><?= $customer['ContactName'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Contact Title</label>
                                   <p class="lead"><?= $customer['ContactTitle'] ?></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label>Address</label>
                                   <p class="lead"><?= $customer['Address'] ?></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label>City</label>
                                   <p class="lead"><?= $customer['City'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Postal Code</label>
                                   <p class="lead"><?= $customer['PostalCode'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Country</label>
                                   <p class="lead"><?= $customer['Country'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Phone</label>
                                   <p class="lead"><?= $customer['Phone'] ?></p>
                              </div>
                              <div class="col">
                                   <label>Fax</label>
                                   <p class="lead"><?= $customer['Fax'] ?></p>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card">
                    <div class="card-block col">
                         <h1 class="card-text col">Customer Orders</h1>
                         <?php
                         $sql = "SELECT o.OrderID, SUM(od.UnitPrice*od.Quantity) AS 'Order Total', o.OrderDate, o.ShippedDate
               FROM `customers` AS c 
               JOIN `orders` AS o ON c.CustomerID = o.CustomerID 
               JOIN `order_details` AS od ON o.OrderID = od.OrderID
               WHERE c.CustomerID = '$customerID' GROUP BY o.OrderID";

                         $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));

                         if (mysqli_num_rows($results)) {
                              echo '<div class="card"><ul class="list-group list-group-flush">';
                              while ($row = mysqli_fetch_array($results)) {
                                   echo'<li class="list-group-item">'
                                   . '<div class="col"><label>Order ID</label><br> ' . "<a href='CustomerOrders.php?customerID=" . $customer['CustomerID'] . "&orderID=" . $row['OrderID'] . "'>" . $row['OrderID'] . '</a></div>'
                                   . '<div class="col"><label>Order Total</label><br>' . money_format("$%i",$row['Order Total']) . '</div>'
                                   . '<div class="col"><label>Date Ordered</label><br>' . $row['OrderDate'] . '</div>'
                                   . '<div class="col"><label>Date Shipped</label><br>' . $row['ShippedDate'] . '</div>'
                                   . '</li>';
                              }
                              echo '</ul>'
                              . '</div>';
                         } else {
                              echo '<p> No Orders found. </p>';
                         }
                         mysqli_close($db);
                         ?>
                         <?php
                         require('Includes/Footer.html');
                         ?>
                    </div>
                    <div class="card-text text-right">
                              <a href='Customers.php'><button type="button" class="btn btn-danger btn-lg">Back</button></a>
                         </div>
               </div>
          </div>
     </body>
</html>
