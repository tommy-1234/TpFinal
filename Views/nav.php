<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Rekluting</strong>
     </span>
     <ul class="navbar-nav ml-auto">

     <!--     <li class="nav-item">
               <a class="nav-link" href="<?php // echo FRONT_ROOT ?>Company/ShowListView">Companies List</a>
          </li>   
          <?php //if(isset($_SESSION['loggedAdmin'])){ ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php // echo FRONT_ROOT ?>Company/ShowAddView">Add Company</a>
          </li>                     
          <?php  // }?>
          <li class="nav-item">
               <a class="nav-link" href="<?php // echo FRONT_ROOT ?>User/ShowDetailView">My info</a>
          </li>

          -->

          <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Companies</a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowListView">List</a>
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Job Offers</a>
               </div>
          </li>      

          <?php if(isset($_SESSION['loggedAdmin'])){ ?>
               <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/ShowListView">Student List</a>
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Student Requests</a>
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowListView">ABM Companies</a>
                         <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">ABM Job Offers</a>
                    </div>
               </li>          
          <?php }?>
          
          <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">My Profile</a>
               <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/ShowDetailView">My Info</a>
                    <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/ShowListView">My Proposals</a>
                    
               </div>
          </li>



          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout</a>
          </li>  
     </ul>
</nav>