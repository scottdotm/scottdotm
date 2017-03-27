<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
     <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
     </button>
     <!-- Graphic -->
     <a class="navbar-brand" href="http://scottdotm.com/Index.php">ScottDotM - Web Development</a>

     <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav mr-auto">
<!--               <li class="nav-item <?= $_indexActive; ?>">
                    <a class="nav-link" href="/Index.php">Home <span class="sr-only">(current)</span></a>
               </li>-->
               <li class="nav-item <?= $_aboutActive; ?>">
                    <a class="nav-link" href="/About.php"> About <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item <?= $_contactActive; ?>">
                    <a class="nav-link" href="/Contact.php">Contact <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Project Progress</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                         <a class="dropdown-item" href="https://docs.google.com/spreadsheets/d/1q3cv_RZd6u0X08_8hYlzEkpmyo4DWCA-ocpdA614sEE/edit?usp=sharing" target="_blank">Zinc Inc. Project</a>
                         <a class="dropdown-item" href="https://github.com/scottdotm/" target="_blank">Code Repository</a>
                    </div>
               </li>
          </ul>
<!--          <form class="form-inline my-2 my-lg-0" _lpchecked="1">
               <input class="form-control mr-sm-2" type="text" disabled="disabled" placeholder="Search">
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit" disabled="disabled">Search</button>
          </form>-->
     </div>
</nav>
<?php

/**
 * Description of Navbar
 *
 * @author Scott Muth <scottdotm.com>
 */
