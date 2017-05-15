<?php
//include custom functions
require('Includes/Functions.php');
//include database connection
require('Includes/DB.connect');
//set title of page
$title = "Table List";
// NEED to start the session BEFORE any ECHO or HTML
session_name('smuth4_final_project'); // needs to come before session_start
session_start();
?>
<!DOCTYPE html>
<!-- 
/**
 * Description of Home
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
          $sort = formVal('sort', 'Name');
          $dir = formVal('dir', 'ASC');
          $start = formVal('start', 0);
          $per_page = formVal('per_page', 10);

          $sort = in_array($sort, ['Name', 'Description']) ? $sort : 'Name';
          $dir = $dir == "ASC" ? "ASC" : "DESC";
          $per_page = in_array($per_page, [10, 50, 100, 100000000000000]) ? $per_page : 10;
          $start = in_array($per_page, [0]) ? $per_page : 0;

          /* check connection */
          if (mysqli_connect_errno()) {
               printf("Connect failed: %s\n", mysqli_connect_error());
               exit();
          }
          $sql = "SELECT OfferedServiceID, Name, Description 
			FROM OfferedServices 
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
               <label>Per page: 
                    <select name="per_page" onchange="this.form.submit();">
                         <option value="10" <?= $per_page == 10 ? "selected" : "" ?> >10</option>
                         <option value="50" <?= $per_page == 50 ? "selected" : "" ?> >50</option>
                         <option value="100" <?= $per_page == 100 ? "selected" : "" ?> >100</option>
                         <option value="100000000000000" <?= $per_page == 100000000000000 ? "selected" : "" ?> >All</option>
                    </select>
               </label>
               <!--<input type="hidden" name="start" value="0">-->
               <noscript>
               <input type="submit" value="Submit">
               </noscript>
          </form>

          <table class="table table-hover table-inverse bg-primary">
               <thead>
                    <tr>
                         <th><a href="?sort=Name&dir=<?= ($sort == "Name" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-primary">Name</button></a></th>
                         <th><a href="?sort=Description&dir=<?= ($sort == "Description" and $dir == "ASC") ? "DESC" : "ASC" ?>"><button type="button" class="btn btn-primary">Description</button></a></th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    // output results
                    // loop while we have more rows
                    while ($row = mysqli_fetch_array($result)) {
                         echo '<tr>
				<td><a href="Quote.php?OfferedServiceID=' . $row['OfferedServiceID'] . '"><button type="button" class="btn btn-primary">' . $row['Name'] . '</button></a></td>
				<td>' . $row['Description'] . '</td>
			</tr>';
                    }
                    ?>
               </tbody>
               <tfoot>
                    <tr>
                         <?php
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
                                   echo '<a href="?start=' . $prev_start . '&per_page=' . $per_page . '">Prev</a>';
                              endif;
                              ?>
                         </td>
                         
                         <td>
                              <?php if (($next_start + 1) <= $total_records): ?>
                                   <a href="?start=<?= $next_start ?>&per_page=<?= $per_page ?>">Next</a>
                              <?php endif; ?>
                         </td>
                    </tr>
               </tfoot>
          </table>
          <?php
          mysqli_close($db);
          require('Includes/Footer.html.php');
          ?>
     </body>
</html>
