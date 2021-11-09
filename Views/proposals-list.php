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
        <br>
        <table style="text-align:center;" class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th style ="width: 20%;">Company</th>
              <th style="width: 20%;">Job Position</th>
              <th style="width: 20%;">Postulation Date</th>
            </tr>
          </thead>
          <tbody>     
                <?php foreach($jobRequestList as $jobRequest){?>
                  <tr>
                    <td><?php echo $jobRequest->getJobOffer()->getCompany()->getCompanyName();?></td>
                    <td><?php echo $jobRequest->getJobOffer()->getJobPosition()->getDescription();?></td>
                    <td><?php echo $jobRequest->getPostulationDate();?></td>
                  </tr>
                  <?php } ?>
          </tbody>
        </table>
        <div class="alert alert-<?php echo $alert->getType()?>" role="alert" style="display: inline-block;  margin:auto">
          <?php echo $alert->getMessage(); ?>
        </div>
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