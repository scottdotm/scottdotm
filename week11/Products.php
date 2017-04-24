<?php
require('Includes/Session.php');
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
          // Northwind/Products database connection and Navbar
          $pagename = basename(__FILE__, '.php');
          require('Includes/Navbar.html.php');
          require('Includes/Northwind.DB.php');
          // get sort, default to Country Name
          $sort = formVal('sort', 'ProductName');
          $dir = formVal('dir', 'ASC');
          $start = formVal('start', 0);
          $per_page = formVal('per_page', 5);
//create query, ALWAYS use double quotes
          $sql = "SELECT p.ProductID, p.ProductName, s.CompanyName, c.CategoryName FROM `products` AS p JOIN categories AS c ON p.CategoryID = c.CategoryID JOIN suppliers AS s ON p.SupplierID = s.SupplierID ORDER BY $sort $dir";
//execute query
// $result is just a REFERANCE to the database result
// get total number of records
          $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          $total_records = mysqli_num_rows($result);

// add limit to query to fetch just one page
          $sql .= " LIMIT $start, $per_page";

//execute additonal query based on Pagination
// $result is just a REFERANCE to the database result
          $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          ?>
          <h1 class="FerroFont text-center" style="font-size: 150px;">Northwind Products</h1>
          <div class="container">
<!--               <pre>
               <?php //print_r($_SESSION); ?>
               </pre>-->
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
                    <noscript>
                    <input type="submit" value="Submit">
                    </noscript>
               </form>
               <!-- DB OUTPUT TABLE -->
               <div class="row">
                    <table class="table tabel-bordered table-hover table-inverse">
                         <thead>
                              <tr>
                                   <th><a href="?sort=p.ProductName&dir=<?= ($sort == "p.ProductName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Product Name</a></th>
                                   <th><a href="?sort=s.CompanyName&dir=<?= ($sort == "s.CompanyName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Company Name</a></th>
                                   <th><a href="?sort=c.CategoryName&dir=<?= ($sort == "c.CategoryName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Category Name</a></th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              //output results
                              //loop while we have rows
                              while ($row = mysqli_fetch_array($result)) {
                                   //$row is one record from the database
                                   //$row only contains the columns you "SELECT"ed
                                   echo "<tr>";
                                   echo "<td><a href='Product.php?ProductID=" . $row['ProductID'] . "'>" . $row['ProductName'] . "</a></td>";
                                   echo "<td>" . $row['CompanyName'] . "</td>";
                                   echo "<td>" . $row['CategoryName'] . "</td>";
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
                                   <td class='text-center'>
                                        <?php if ($prev_start >= 0): ?>
                                             <a class='btn btn-lg btn-info col' href="?start=<?= $prev_start ?>&per_page=<?= $per_page ?>">Prev</a>
                                        <?php endif; ?>
                                   </td>
                                   <td></td>
                                   <td class='text-center'>
                                        <?php if (($next_start + 1) <= $total_records): ?>
                                             <a class='btn btn-lg btn-info col' href="?start=<?= $next_start ?>&per_page=<?= $per_page ?>">Next</a>
                                        <?php endif; ?>
                                   </td>
                              </tr>
                         </tfoot>
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
