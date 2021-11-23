<?php
    require_once("nav.php");
    /// print_r($JobOffer);
?>

<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      
      <form action="<?php echo FRONT_ROOT."JobOffer/Remove"?>" method="post">
        <br>
        
        <table style="text-align:center;" class="table table-bordered">
          <tbody>  
                <tr>
                  <td style="font-weight:bold;" >Company Name</td>
                  <td><?php echo $JobOffer->getCompany()->getCompanyName();?>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Career</td>
                  <td><?php echo $JobOffer->getJobPosition()->getCareer()->getDescription();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Job Position</td>
                  <td><?php echo $JobOffer->getJobPosition()->getDescription();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Publication Date</td>
                  <td><?php echo $JobOffer->getPublicationDate();?>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Expiration Date</td>
                  <td><?php echo $JobOffer->getExpirationDate();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Is Remote</td>
                  <td><?php 
                  if($JobOffer->getIsRemote()){
                    echo "Yes";
                  }else{
                    echo "No";
                  }?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Proyect Description</td>
                  <td><?php echo $JobOffer->getProjectDescription();?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Hourly Load</td>
                  <td><?php echo $JobOffer->getHourlyLoad();?>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Is Active</td>
                  <td><?php 
                  if($JobOffer->getActive()){
                    echo "Yes";
                  }else{
                    echo "No";
                  }?></td>
                </tr>
         </tbody>
        </table>

        <table>
          <tbody>
                  <?php if(isset($_SESSION['loggedAdmin'])){ ?>
                    <br>
                    <td>
                      <button type="submit" class="btn" name="jobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>"> Remove </button>
                    </td> 
                    <td>
                      <button type="submit" class="btn" name="jobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>" formaction="<?php echo FRONT_ROOT."JobOffer/ShowUpdate"?>"> Modify </button>
                    </td>                   
                    
                  <?php }else if (isset($_SESSION["loggedStudent"])){ ?>
                    <td>
                        <button type="submit" class="btn" name="jobOfferId" value="<?php echo $JobOffer->getJobOfferId()?> "formaction="<?php echo FRONT_ROOT."JobRequest/ShowPostulationView"?>" method="post"> Postulate </button>
                    </td>   
                    <?php }?> 
                    
                    <td>
                        <button type="submit" name="" class="btn" value="" formaction="<?php echo FRONT_ROOT."JobOffer/ShowListView" ?>" > Back </button>
                    </td> 
            </tbody>
        </table>

      </form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>