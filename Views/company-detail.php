<?php
require_once("nav.php");
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Company/Remove"?>" method="post">
        <br>
        <table style="text-align:center;" class="table table-bordered">
          <tbody>  
                <tr>
                  <td style="font-weight:bold;" >Name</td>
                  <td><?php echo $company->getCompanyName();?>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Description</td>
                  <td><?php echo $company->getCompanyDescription();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Email</td>
                  <td><?php echo $company->getCompanyEmail();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Phone</td>
                  <td><?php echo $company->getCompanyPhone();?></td>
               </tr>
                <tr>
                  <td style="font-weight:bold;">Linkedin</td>
                  <td><?php echo $company->getCompanyLinkedin();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Address</td>
                  <td><?php echo $company->getCompanyAddress();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Link</td>
                  <td><?php echo $company->getCompanyLink();?></td>
                </tr>
         </tbody>
        </table>

        <table>
          <tbody>
                  <?php if(isset($_SESSION['loggedAdmin'])){ ?>
                    <br>
                    <td>
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>"> Remove </button>
                    </td> 
                    <td>
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>" formaction="<?php echo FRONT_ROOT."Company/ShowUpdate"?>"> Modify </button>
                    </td> 
                    <td>
                      <button type="submit" name="" class="btn" value="" formaction="<?php echo FRONT_ROOT."Company/ShowListView" ?>" > Back </button>
                    </td> 
                    
                  <?php }?> 
            </tbody>
        </table>

      </form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>