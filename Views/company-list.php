<?php
require_once("header.php");
require_once("nav.php");
?>

<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Company/Detaile"?>" method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style ="width: 20%;">Company Name</th>
              <th style="width: 50%;">Company Description</th>
              <th style="width: 10%;"></th>
            </tr>
          </thead>
          <tbody>     
                <?php foreach($companyList as $company){?>
                  <tr>
                    <td><?php echo $company->getCompanyName();?>
                    <td><?php echo $company->getCompanyDescription();?></td>
                    <td>
                      <button type="submit" class="btn" name="idCompany" value="<?php echo $company->getIdCompany() ?>"> More Details </button>
                    </td>
                  </tr>
                  <?php } ?>
          </tbody>
        </table></form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<?php
require_once("footer.php");

