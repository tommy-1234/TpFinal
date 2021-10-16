<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Framework</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowAddView">Agregar Alumno</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Listar Alumnos</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Listar Empresas</a>
          </li>   
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Cerrar Session</a>
          </li>  
          <?php if(isset($_SESSION['loggedAdmin'])){ ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar Empresa</a>
          </li>                     
          <?php  }?>
     </ul>
</nav>