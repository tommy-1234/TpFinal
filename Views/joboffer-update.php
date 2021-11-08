<?php
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


        <form action="<?php echo FRONT_ROOT."JobOffer/Update"?>" method="post">
        
        <table style="text-align:left;" class="table table-bordered">
          <tbody>  
                <tr>
                    <td style="font-weight:bold;" >Company</td>
                    <td >
                    <select class="form-control" id="company" name="idCompany">
                    <?php foreach($companyList as $company){?>
                        <option value=<?php echo $company->getIdCompany();?> <?php echo ($company->getIdCompany()==$JobOffer->getCompany()->getIdCompany() ? "selected" : "") ;?> ><?php echo $company->getCompanyName();?></option>
                    <?php } ?>
                    </select>
                    </td>
                </tr>

                <tr>
                    <td style="font-weight:bold;" >Job Position</td>
                    <td >
                    <select class="form-control" id="jobposition" name="jobPositionId">
                        <?php foreach($JobPositionList as $JobPosition){?>
                            <option value=<?php echo $JobPosition->getJobPositionId();?> <?php echo ($JobPosition->getJobPositionId()==$JobOffer->getJobPosition()->getJobPositionId() ? "selected" : "");?> ><?php echo $JobPosition->getDescription()." - ".$JobPosition->getCareer()->getDescription();?></option>
                        <?php } ?>
                    </select>
                    </td>
                </tr>

                <tr>
                    <td style="font-weight:bold;" >Publication Date</td>
                    <td><input type="date" id="publication" name="publicationDate" value="<?php echo $JobOffer->getPublicationDate()?>" required></td>
                </tr>

                <tr>
                    <td style="font-weight:bold;" >Expiration Date</td>
                    <td><input type="date" id="expirationDate" name="expirationDate" value="<?php echo $JobOffer->getExpirationDate()?>" required></td>
                </tr>
                
                <tr>
                    <td style="font-weight:bold;" >Is Remote</td>
                    <td>
                        <input type="radio" id="yes" value="1" name="isRemote" required <?php echo ($JobOffer->getIsRemote() ? "checked" : "")?>>
                        <label for="yes">Yes </label>
                        <input type="radio" id="no" value="0" name="isRemote" required <?php echo (!$JobOffer->getIsRemote() ? "checked" : "")?>>
                        <label for="no">No</label>
                    </td>
                </tr>

                <tr>
                    <td style="font-weight:bold;" >Project Description</td>
                    <td><textarea name="projectDescription" id="text" cols="80" rows="4"> <?php echo $JobOffer->getProjectDescription()?> </textarea></td>
                </tr>

                <tr>
                    <td style="font-weight:bold;" >Hourly Load</td>
                    <td><input type="number" id="hourlyLoad" name="hourlyLoad" value="<?php echo $JobOffer->getHourlyLoad()?>" required></td>
                </tr>
                
                <tr>
                    <td style="font-weight:bold;" >Active</td>
                    <td>
                        <input type="radio" id="yes" value="1" name="jobOfferActive" required <?php echo ($JobOffer->getActive() ? "checked" : "")?>>
                        <label for="yes">Yes </label>
                        <input type="radio" id="no" value="0" name="jobOfferActive" required <?php echo (!$JobOffer->getActive() ? "checked" : "")?>>
                        <label for="no">No</label>
                    </td>
                </tr>


            <br>
            <br>
            <!--<input type="submit" value="ADD"> -->
            <br>
            </table>
            <button type="submit" class="btn" >Update</button>
            <!--<button type="submit" name="" class="btn" value="" formaction="<?php echo FRONT_ROOT."Company/ShowListView" ?>" > Back </button> -->
            <div style="display: inline-block; margin:auto" class="alert alert-<?php echo $alert->getType()?>" role="alert">
                <?php echo $alert->getMessage(); ?>
            </div>
        </form>


        </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>




<?
$_SESSION['alert'] = null;
?>