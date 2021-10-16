<?php
require_once("nav.php");
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Company/Remove"?>" method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style ="width: 15%;">Nombre</th>
              <th style="width: 15%;">Descripcion</th>
              <th style="width: 30%;">Email</th>
              <th style="width: 30%;">Telefono</th>
              <th style="width: 15%;">Linkedin</th>
              <th style="width: 10%;">Direccion</th>
              <?php if(isset($_SESSION['loggedAdmin'])){?>
                <th style="width: 10%;">Accion</th>
              <?php }?>
            </tr>
          </thead>
          <tbody>  
                <tr>
                  <td><?php echo $company->getCompanyName();?>
                  <td><?php echo $company->getCompanyDescription();?></td>
                  <td><?php echo $company->getCompanyEmail();?></td>
                  <td><?php echo $company->getCompanyPhone();?></td>
                  <td><?php echo $company->getCompanyLinkedin();?></td>
                  <td><?php echo $company->getCompanyAddress();?></td>
                  <?php if(isset($_SESSION['loggedAdmin'])){ ?>
                    <td>
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>"> Borrar </button>
                    </td> 
                    <td>
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>" formaction="<?php echo FRONT_ROOT."Company/ShowUpdate"?>"> Modificar </button>
                    </td> 
                  <?php }?> 
                </tr>
          </tbody>
        </table></form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>