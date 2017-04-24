<?php
require('Includes/Session.php');
require('Includes/Northwind.DB.php');
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
                         $sort = formVal('sort', 'c.CompanyName');
                         $dir = formVal('dir', 'ASC');
                         $start = formVal('start', 0);
                         $per_page = formVal('per_page', 5);


                         $sql = "SELECT o.OrderID, SUM(od.UnitPrice*od.Quantity) AS 'Order Total', o.OrderDate, o.ShippedDate , c.CustomerID
               FROM `customers` AS c 
               JOIN `orders` AS o ON c.CustomerID = o.CustomerID 
               JOIN `order_details` AS od ON o.OrderID = od.OrderID
               WHERE c.CustomerID = '$customerID' GROUP BY o.OrderID ORDER BY $sort $dir";

                         $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
                         $total_records = mysqli_num_rows($results);

                         // add limit to query to fetch just one page
                         $sql .= " LIMIT $start, $per_page";
                         //execute additonal query based on Pagination
                         // $result is just a REFERANCE to the database result
                         $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
                         ?>
                         <form method="get">
                              <label>Per page: 
                                   <select name="per_page" onchange="this.form.submit();">
                                        <option value="5" <?= $per_page == 5 ? "selected" : "" ?> >5</option>
                                        <option value="10" <?= $per_page == 10 ? "selected" : "" ?> >10</option>
                                        <option value="50" <?= $per_page == 50 ? "selected" : "" ?> >50</option>
                                        <option value="100" <?= $per_page == 100 ? "selected" : "" ?> >100</option>
                                        <option value="100000000000000" <?= $per_page == 100000000000000 ? "selected" : "" ?> >All</option>
                                   </select>
                              </label>
                              <input type='hidden' name='customerID' value='<?= $customer['CustomerID'] ?>'>
                              <noscript>
                              <input type="submit" value="Submit">
                              </noscript>
                         </form>
                         <table class="table tabel-bordered table-hover table-inverse">
                              <thead>
                                   <tr>
                                        <th><a href="?sort=o.OrderID&dir=<?= ($sort == "o.OrderID" and $dir == "ASC") ? "DESC" : "ASC" ?>">Order ID</a></th>
                                        <th><a href="?sort=Order Total&dir=<?= ($sort == "'Order Total'" and $dir == "ASC") ? "DESC" : "ASC" ?>">Order Total</a></th>
                                        <th><a href="?sort=o.OrderDate&dir=<?= ($sort == "o.OrderDate" and $dir == "ASC") ? "DESC" : "ASC" ?>">Date Ordered</a></th>
                                        <th><a href="?sort=o.ShippedDate&dir=<?= ($sort == "o.ShippedDate" and $dir == "ASC") ? "DESC" : "ASC" ?>">Date Shipped</a></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
//OUTPUT CUSTOMER RESULTS
//loop while we have rows
                                   while ($row = mysqli_fetch_array($results)) {
                                        //$row is one record from the database
                                        //$row only contains the columns you "SELECT"ed
                                        echo "<tr>";
                                        echo "<td><a href='CustomerOrders.php?customerID=" . $customer['CustomerID'] . "&orderID=" . $row['OrderID'] . "'>" . $row['OrderID'] . '</a></div>';
                                        echo "<td>" . money_format("$%i", $row['Order Total']) . "</td>";
                                        echo "<td>" . $row['OrderDate'] . "</td>";
                                        echo "<td>" . $row['ShippedDate'] . "</td>";
                                        echo "</tr>";
                                   }
                                   ?>
                              </tbody>
                              <tfoot>
                                   <tr>
                                        <?php
                                        $prev_start = $start - $per_page;
                                        $next_start = $start + $per_page;
                                        ?>
                                        <td>
                                             <?php if ($prev_start >= 0): ?>
                                                  <a class='btn btn-lg btn-info col' href="?customerID=<?= $customer['CustomerID'] ?>&start=<?= $prev_start ?>&per_page=<?= $per_page ?>">Prev</a>
                                             <?php endif; ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td class='text-center'>
                                             <?php if (($next_start + 1) <= $total_records): ?>
                                                  <a class='btn btn-lg btn-info col' href="?customerID=<?= $customer['CustomerID'] ?>&start=<?= $next_start ?>&per_page=<?= $per_page ?>">Next</a>
                                             <?php endif; ?>
                                        </td>
                                   </tr>
                              </tfoot>
                         </table>
                         <?php
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