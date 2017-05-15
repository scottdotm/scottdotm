<?php
//include custom functions
require('Includes/Functions.php');
//include database connection
require('Includes/DB.connect');
//set title of page
$title = "Quote List";
// NEED to start the session BEFORE any ECHO or HTML
session_name('smuth4_final_project'); // needs to come before session_start
session_start();
?>
<!DOCTYPE html>
<!-- 
/**
 * Description of Quote List
 *
 * @author Scott Muth <scottdotm.com>
 */
-->
<html lang="en">
     <?php
     require('Includes/Header.html.php');
     ?>
     <body class="bg-faded">
          <?php
          require('Includes/Navbar.html.php');
          ?>

          <?php
          $sort = formVal('sort', 'FirstName');
          $dir = formVal('dir', 'ASC');
          $start = formVal('start', 0);
          $per_page = formVal('per_page', 10);

          $sort = in_array($sort, ['FirstName', 'LastName', 'Email', 'ReferredBy', 'Phone', 'Name', 'Description']) ? $sort : 'Name';
          $dir = $dir == "ASC" ? "ASC" : "DESC";

          /* check connection */
//          if (mysqli_connect_errno()) {
//               printf("Connect failed: %s\n", mysqli_connect_error());
//               exit();
//          }
          
          $sql = "SELECT QuoteID, FirstName, LastName, Email, ReferredBy, Comment, Phone, OS.Name, OS.Description, Q.OfferedServiceID 
			FROM Quotes AS Q 
                        JOIN OfferedServices AS OS
                        ON Q.OfferedServiceID = OS.OfferedServiceID
			ORDER BY $sort $dir ";

// get total number of records
          $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          $total_records = mysqli_num_rows($result);

// add limit to query to fetch just one page
          $sql .= " LIMIT $start, $per_page";
          
          

// execute query
// $result is just a REFERENCE to the database result
          $result = mysqli_query($db, $sql) or die("Error in query: " . mysqli_error($db));
          ?>
          <form method="get">
               <div class="card">
               <label for="per_page">Per page: </label>
                    <select class="form-control" id="per_page" name="per_page" onchange="this.form.submit();">
                         <option value="10" <?= $per_page == 10 ? "selected" : "" ?> >10</option>
                         <option value="50" <?= $per_page == 50 ? "selected" : "" ?> >50</option>
                         <option value="100" <?= $per_page == 100 ? "selected" : "" ?> >100</option>
                         <option value="100000000000000" <?= $per_page == 100000000000000 ? "selected" : "" ?> >All</option>
                    </select>
               </div>
               
               <!--<input type="hidden" name="start" value="0">-->
               <noscript>
               <input type="submit" value="Submit">
               </noscript>
          </form>

          <table class="table table table-bordered table-hover table-inverse bg-primary">
               <thead>
                    <tr>
                         <th><a href="?sort=FirstName&dir=<?= ($sort == "FirstName" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-lg btn-info col">First Name</button></a></th>
                         <th><a href="?sort=LastName&dir=<?= ($sort == "LastName" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-lg btn-info col">Last Name</button></a></th>
                         <th><a href="?sort=Email&dir=<?= ($sort == "Email" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-lg btn-info col">Email</button></a></th>
                         <th><a href="?sort=ReferredBy&dir=<?= ($sort == "ReferredBy" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-lg btn-info col">Referred By</button></a></th>
<!--                         <th><a href="?sort=Comment&dir=<?= ($sort == "Comment" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-primary">Comment</button></a></th>-->
                         <th><a href="?sort=Phone&dir=<?= ($sort == "Phone" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-lg btn-info col">Phone</button></a></th>
                         <th><a href="?sort=Name&dir=<?= ($sort == "Name" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-lg btn-info col">Service</button></a></th>
                         
                         <th>Edit/Delete</th>

                    </tr>
               </thead>
               <tbody>
                    <?php
// output results
// loop while we have more rows
                    while ($row = mysqli_fetch_array($result)) {
                         echo '<tr>
                              <td>' . $row['FirstName'] . '</td>
                              <td>' . $row['LastName'] . '</td>
                              <td>' . $row['Email'] . '</td>
                              <td>' . $row['ReferredBy'] . '</td>                            
                              <td>' . $row['Phone'] . '</td>
                              <td>' . $row['Name'] . '</td>
                              
                              <td><a href="QuoteEdit.php?QuoteID=' . $row['QuoteID'] . '"><button type="button" class="btn btn-success">Edit</button></a> <a href="QuoteDelete.php?QuoteID=' . $row['QuoteID'] . '"><button type="button" class="btn btn-danger">Delete</button></a> </td>
                              
			</tr>';
                    }
                    ?>
               </tbody>
               <tfoot>
                    <tr class="">
                         <?php
                         $per_page;
                         $prev_start = $start - $per_page;
                         $next_start = $start + $per_page;

                         // set previous start to 0 if we don't have a "full" page to go back to
                         if ($prev_start < 0 and $start > 0) {
                              $prev_start = 0;
                         }
                         ?>
                         <td>
                              <?php
                              if ($prev_start >= 0):
                                   echo '<a href="?start=' . $prev_start . '&per_page=' . $per_page . '"><button type="button" class="btn btn-primary">Prev</button></a>';
                              endif;
                              ?>
                         </td>
                         <td colspan="5"><a href="ServiceList.php"><button class="btn btn-lg btn-info col">Add New Quote</button></a></td>
                         
                         
                         <td>
                              <?php if (($next_start + 1) <= $total_records): ?>
                                   <a href="?start=<?= $next_start ?>&per_page=<?= $per_page ?>"><button type="button" class="btn btn-primary">Next</button></a>
                              <?php endif; ?>
                         </td>
                    </tr>
               </tfoot>
          </table>
          
          <?php
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
