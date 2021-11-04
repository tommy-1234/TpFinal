<?php
require_once("header.php");
require_once("nav.php");
if(isset($_SESSION['alert'])){
  $alert = $_SESSION['alert'];
}
?>

<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">

      
      <form action="<?php echo FRONT_ROOT."JobOffer/ShowDetail"?>" method="post">
      <br>
        <table style="text-align:center;" class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th style ="width: 25%;">Career</th>
              <th style ="width: 25%;">Job Position</th>
              <th style ="width: 25%;">Company Name</th>
              <th style ="width: 15%;">Hourly Load</th>
              <th style ="width: 10%;">
              <?php if(isset($_SESSION['loggedAdmin'])){ ?>
                  <button type="submit" name="" class="btn" value="" formaction="<?php echo FRONT_ROOT."JobOffer/ShowAddView" ?>" >New Job Offer</button>
                <?php } ?>
              </th> 
            </tr>
          </thead>
          <tbody>     
                <?php foreach($JobOfferList as $JobOffer){?>
                  <tr>
                    <td><?php echo $JobOffer->getJobPosition()->getCareer()->getDescription();?></td>
                    <td><?php echo $JobOffer->getJobPosition()->getDescription();?></td>
                    <td><?php echo $JobOffer->getCompany()->getCompanyName();?></td>
                    <td><?php echo $JobOffer->getHourlyLoad();?></td>
                    
                    <td>
                      <button type="submit" class="btn" name="jobOfferId" value="<?php echo $JobOffer->getJobOfferId() ?>"> More Details </button>
                    </td>
                   
                  </tr>
                <?php } ?>
          </tbody>
        </table>
        <div class="alert alert-<?php echo $alert->getType()?>" role="alert" style="display: inline-block;  margin:auto">
          <?php echo $alert->getMessage(); ?>
        </div></form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<?php
require_once("footer.php");
$_SESSION['alert'] = null;
?>