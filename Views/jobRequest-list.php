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
      
     <!-- <br>
      <form action="<?php //echo FRONT_ROOT."Company/Filter"?>" method="post">
        <input type="text" name="filterCompany" placeholder="Company Name">
        <input type="submit" value="Filter">
      </form> 
 
      <form action="<?php //echo FRONT_ROOT."Company/Detaile"?>" method="post">
      <br>-->
        <?php if(isset($_SESSION['loggedAdmin'])){ ?>
        <table style="text-align:center;" class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th style ="width: 20%;">Job Request ID</th>
              <th style ="width: 20%;">Company</th>
              <th style ="width: 20%;">Job Position</th>
              <th style ="width: 40%;">Student Name </th>
              <th style ="width: 20%;">Postulation Date</th>
              <th style ="width: 20%;">Active</th>
            </tr>
          </thead>
          <tbody>     
                <?php foreach($jobRequestList as $jobRequest){?>
                  <tr>
                    <td><?php echo $jobRequest->getJobRequestsId();?></td>
                    <td><?php echo $jobRequest->getJobOffer()->getCompany()->getCompanyName();?></td>
                    <td><?php echo $jobRequest->getJobOffer()->getJobPosition()->getDescription();?></td>
                    <td><?php echo $jobRequest->getStudenId()->getFirstName() . " " . $jobRequest->getStudenId()->getLastName();?></td>
                    <td><?php echo $jobRequest->getPostulationDate();?></td>
                    <td><?php if($jobRequest->getJobRequestsActive() == 1){  
                          echo "✔";
                    }else{
                        echo "❌";
                    }?></td>
                    <!--<td>
                      <button type="submit" class="btn" name="idCompany" value="<?php //echo $company->getIdCompany() ?>"> More Details </button>
                    </td> -->
                  </tr>
                  <?php } ?>
          </tbody>
        </table>
        <div class="alert alert-<?php echo $alert->getType()?>" role="alert" style="display: inline-block;  margin:auto">
          <?php echo $alert->getMessage(); ?>
        </div><!--</form> -->
        <?php } ?>
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