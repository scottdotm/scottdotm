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
          $pagename = basename(__FILE__, '.php');
          //Navbar include
          require('Includes/Navbar.html.php');
          // Northwind database connection
          require('Includes/Northwind.DB.php');
          // get sort, default to Country Name
          $sort = formVal('sort', 'c.CompanyName');
          $dir = formVal('dir', 'ASC');
          $start = formVal('start', 0);
          $per_page = formVal('per_page', 5);
          //create query, ALWAYS use double quotes
          $sql = "SELECT c.CustomerID, c.CompanyName, c.ContactName, c.ContactTitle, c.Address, c.City, c.Region, c.PostalCode, c.Country, c.Phone, c.Fax, c.Region
                  FROM `customers` AS c
                  ORDER BY $sort $dir";
          //execute query
          $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          $total_records = mysqli_num_rows($results);
          // add limit to query to fetch just one page
          $sql .= " LIMIT $start, $per_page";
//execute additonal query based on Pagination
// $result is just a REFERANCE to the database result
          $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          ?>
          <div class='FerroFont text-center' style="font-size: 150px;">Northwind Customers</div>
          <div class="container-fluid">  
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
               <div class="row">
                    <table class="table tabel-bordered table-hover table-inverse">
                         <thead>
                              <tr>
                                   <th><a href="?sort=c.CompanyName&dir=<?= ($sort == "c.CompanyName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Company Name</a></th>
                                   <th><a href="?sort=c.ContactName&dir=<?= ($sort == "c.ContactName" and $dir == "ASC") ? "DESC" : "ASC" ?>">Contact Name</a></th>
                                   <th><a href="?sort=c.City&dir=<?= ($sort == "c.City" and $dir == "ASC") ? "DESC" : "ASC" ?>">City</a></th>
                                   <th><a href="?sort=c.Region&dir=<?= ($sort == "c.Region" and $dir == "ASC") ? "DESC" : "ASC" ?>">Region</a></th>
                                   <th><a href="?sort=c.Country&dir=<?= ($sort == "c.Country" and $dir == "ASC") ? "DESC" : "ASC" ?>">Country</a></th>
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
                                   echo "<td><a href='Customer.php?customerID=" . $row['CustomerID'] . "'>" . $row['CompanyName'] . "</a></td>";
                                   echo "<td>" . $row['ContactName'] . "</td>";
                                   echo "<td>" . $row['City'] . "</td>";
                                   echo "<td>" . $row['Region'] . "</td>";
                                   echo "<td>" . $row['Country'] . "</td>";
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
                                   <td></td>
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