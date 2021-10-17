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
              <th style ="width: 15%;">Name</th>
              <th style="width: 15%;">Description</th>
              <th style="width: 30%;">Email</th>
              <th style="width: 30%;">Phone</th>
              <th style="width: 15%;">Linkedin</th>
              <th style="width: 10%;"><Address></Address></th>
              <?php if(isset($_SESSION['loggedAdmin'])){?>
                <th style="width: 10%;">Action</th>
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
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>"> Remove </button>
                    </td> 
                    <td>
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>" formaction="<?php echo FRONT_ROOT."Company/ShowUpdate"?>"> Modify </button>
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