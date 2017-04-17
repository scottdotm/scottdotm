<?php
/**
 * Description of Navbar
 *
 * @author Scott Muth <scottdotm.com>
 */

if ($pagename=="Home"){
     $homeActive = 'active';
} else {
     $homeActive = null;
}
if ($pagename=="Customer"||$pagename=="Customers"||$pagename=="CustomerOrders"){
     $customersActive = 'active';
} else {
     $customersActive = null;
}
if ($pagename=="Product"||$pagename=="Products"){
     $productActive = 'active';
} else {
     $productActive=null;
}
?>
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="Home.php">Northwind</a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item <?= $homeActive ?>">
        <a class="nav-link" href="Home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $customersActive ?>" href="Customers.php">Customers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $productActive ?>" href="Products.php">Products</a>
      </li>
    </ul>
  </div>
</nav>