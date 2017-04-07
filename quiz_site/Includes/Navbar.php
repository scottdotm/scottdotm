<?php

/**
 * Description of Navbar
 *   Site-wide navbar
 * @author Scott Muth <scottdotm.com>
 */
include('Includes/Filename.php');

?>
<div class="container">
     <nav id="mainNav" class="navbar navbar-toggleable-md navbar-inverse bg-primary fixed-top">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand page-scroll" href="Index.php">Video Gaming History</a>
          <div class="collapse navbar-collapse" id="navbar">
               <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                         <a class="nav-link <?= $_active ?>" href="Knowledge.php">Knowledge <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link <?= $_Qactive ?>" href="Quiz.php">Quiz <span class="sr-only">(current)</span></a>
                    </li>
               </ul>
          </div>
     </nav>
</div>