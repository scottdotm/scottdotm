<?php
/**
 * Description of Navbar
 *
 * @author Scott Muth <scottdotm.com>
 */
if (isset($_POST['logoutNavSubmit'])) {
     // destroy the session 
     session_destroy();
     // redirect back to city
     header('Location: Home.php');
}
?>
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
     <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
     </button>
     <a class="navbar-brand" href="Home" style="text-shadow: 0px 2px 3px #666;">ScottDotM Web Development</a>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                    <a class="nav-link" href="Home">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="Login">Login</a>
               </li>

               <li class="nav-item">
                    <a class="nav-link" href="CreateAccount">
                         <?php
                         if (isset($_SESSION['userId'])) {
                              echo 'User Profile';
                         } else {
                              echo 'Create Account';
                         }
                         ?>
                    </a>
               </li>
               <li class="nav-item">
                    <form method="post" class="form-inline">
                         <button type="submit" name="logoutNavSubmit" class="form-control">Logout</button>
                    </form>
               </li>
          </ul>
     </div>
</nav>
