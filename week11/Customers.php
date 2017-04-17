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
          //Navbar include
          require('Includes/Navbar.html');
          // Northwind database connection
          require('Includes/Northwind.DB.php');
          //create query, ALWAYS use double quotes
          $sql = "SELECT c.CustomerID, c.CompanyName, c.ContactName, c.ContactTitle, c.Address, c.City, c.Region, c.PostalCode, c.Country, c.Phone, c.Fax, c.Region
                  FROM `customers` AS c
                  ORDER BY c.ContactName";

          //execute query
          $results = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          ?>
          <div class='FerroFont text-center' style="font-size: 150px;">Northwind Customers</div>
          <div class="container">
               <div class="row">
                    <table class="table tabel-bordered table-hover table-inverse">
                         <thead>
                              <tr>
                                   
                                   <th>Contact Name</th>
                                   <th>Company Name</th>
                                   <th>City</th>
                                   <th>Region</th>
                                   <th>Country</th>
                                   
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
                                   echo "<td><a href='Customer.php?customerID=" . $row['CustomerID'] . "'>" . $row['ContactName'] . "</a></td>";
                                   echo "<td>" . $row['CompanyName'] . "</td>";
                                   echo "<td>" . $row['City'] . "</td>";
                                   echo "<td>" . $row['Region'] . "</td>";
                                   echo "<td>" . $row['Country'] . "</td>";
                                   
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
