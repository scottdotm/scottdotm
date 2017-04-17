<?php
require_once('Includes/Northwind.DB.php');
//Give Default Values
$customerID = isset($_GET['customerID']) ? $_GET['customerID'] : 'HILAA';
$orderID = isset($_GET['orderID']) ? $_GET['orderID'] : '10486';
//Customer Query
$sql = "SELECT c.CompanyName, c.ContactName, c.Address, c.Country, c.Fax, c.Phone, c.PostalCode FROM `customers` AS c JOIN `orders` AS o ON c.CustomerID = o.CustomerID JOIN `order_details` AS od ON o.OrderID = od.OrderID JOIN `products`AS p ON od.ProductID = p.ProductID WHERE c.CustomerID = '$customerID' && od.OrderID='$orderID' ORDER BY p.ProductName";
//Execute Customer Query
$results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
//Fetch Customer Rows
$customer = mysqli_fetch_array($results)
?>
<!DOCTYPE html>
<html>
     <?php
     require('Includes/Header.html');
     ?>
     <body>
          <?php
          require('Includes/Navbar.html');
          ?>
          <div class="container">

               <div class='card'>
                    <div class='card'>
                         <div class='card-block col'>
                              <h1 class='row'>Customer Information</h1>
                              <div class='row'>
                                   <div class='col'>
                                        <label>Company Name</label>
                                        <br>
                                        <p class='lead'>
                                             <?= $customer['CompanyName'] ?>
                                        </p>
                                   </div>
                                   <div class='col'>
                                        <label>Contact Name</label>
                                        <br>
                                        <p class='lead'>
                                             <?= $customer['ContactName'] ?>
                                        </p>
                                   </div>
                              </div>
                              <div class='row'>
                                   <div class='col'>
                                        <label>Address</label>
                                        <br>
                                        <p class='lead'>
                                             <?= $customer['Address'] ?>
                                        </p>
                                   </div>
                                   <div class='col'>
                                        <label>Country</label>
                                        <br>
                                        <p class='lead'>
                                             <?= $customer['Country'] ?>
                                        </p>
                                   </div>
                              </div>
                              <div class='row'>
                                   <div class='col'>
                                        <label>Fax</label>
                                        <br>
                                        <p class='lead'>
                                             <?= $customer['Fax'] ?>
                                        </p>
                                   </div>
                                   <div class='col'>
                                        <label>Phone</label>
                                        <br>
                                        <p class='lead'>
                                             <?= $customer['Phone'] ?>
                                        </p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card">
                    <h1 class='card-block '>Order Items</h1>
                    <table class="table tabel-bordered table-hover ">
                         <thead>
                              <tr>
                                   <th>Product Name</th>
                                   <th>Unit Price</th>
                                   <th>Quantity</th>
                                   <th>Quantity Per Unit</th>
                                   <th>Line Price</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              //OrderDetails Query
                              $sql = "SELECT p.ProductName, od.UnitPrice, od.Quantity, p.QuantityPerUnit FROM `customers` AS c JOIN `orders` AS o ON c.CustomerID = o.CustomerID JOIN `order_details` AS od ON o.OrderID = od.OrderID JOIN `products`AS p ON od.ProductID = p.ProductID WHERE c.CustomerID = '$customerID' && od.OrderID='$orderID' ORDER BY p.ProductName";
                              //Execute OrderDetails Query
                              $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
                              //output results
                              //loop while we have rows
                              $total = 0;
                              while ($row = mysqli_fetch_array($results)) {

                                   $lineTotal = ($row['UnitPrice'] * $row['Quantity']);
                                   //$row is one record from the database
                                   //$row only contains the columns you "SELECT"ed
                                   echo "<tr>"
                                   . "<th scope='row'>" . $row['ProductName'] . "</th>";
                                   echo "<td>" . money_format('$%i', $row['UnitPrice']) . "</td>";
                                   echo "<td>" . $row['Quantity'] . "</td>";
                                   echo "<td>" . $row['QuantityPerUnit'] . "</td>";
                                   echo "<td>" . money_format('$%i', $lineTotal) . "</td>";
                                   echo "</tr>";
                                   $total = ($total + $lineTotal);
                              }
                              ?>
                              <tr style='background-color:black;'>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                              </tr>
                              <tr>
                                   <td><p>Total Products: <?= mysqli_num_rows($results) ?></p></td>
                                   <td><p><?= money_format("Total price $%i", $total); ?></p></td>
                              </tr>
                         </tbody>
                    </table>
               </div>
               <?php
               //Execute Order Query
               $sql = "SELECT o.ShipRegion, o.ShipName, o.ShipAddress, o.ShipCity, o.ShipCountry, o.ShipPostalCode, o.ShipRegion FROM `customers` AS c JOIN `orders` AS o ON c.CustomerID = o.CustomerID JOIN `order_details` AS od ON o.OrderID = od.OrderID JOIN `products`AS p ON od.ProductID = p.ProductID WHERE c.CustomerID = '$customerID' && od.OrderID='$orderID' ORDER BY p.ProductName";
               $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
               $order = mysqli_fetch_array($results);
               ?>
               <div class='card'>
                    <div class='card-block col'>
                         <div class="row">
                              <h1>Shipment Information</h1>
                         </div>
                         <div class="row">
                              <div class='col'>
                                   <label>Shipment Name</label>
                                   <br>
                                   <p class='lead'><?= $order['ShipName'] ?></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class='col'>
                                   <label>Shipment Address</label>
                                   <br>
                                   <p class='lead'><?= $order['ShipAddress'] ?></p>
                              </div>
                              <div class='col'>
                                   <label>Shipment City</label>
                                   <br>
                                   <p class='lead'><?= $order['ShipCity'] ?></p>
                              </div>
                              <div class='col'>
                                   <label>Shipment Region</label>
                                   <br>
                                   <p class='lead'><?= $order['ShipRegion'] ?></p>
                              </div>
                         </div>
                         <div class="row">
                              <div class='col'>
                                   <label>Shipment Country</label>
                                   <br>
                                   <p class='lead'><?= $order['ShipCountry'] ?></p>
                              </div>
                              <div class='col'>
                                   <label>Shipment Postal Code</label>
                                   <p class='lead'><?= $order['ShipPostalCode'] ?></p>
                              </div>
                         </div>
                         <div class="card-text text-right">
                              <a href='Customer.php?customerID=<?= $customerID ?>'><button type="button" class="btn btn-danger btn-lg">Back</button></a>
                         </div>
                    </div>
               </div>
          </div>
          <?php
          mysqli_close($db);
          ?>
          <?php
          require('Includes/Footer.html');
          ?>
     </body>
</html>