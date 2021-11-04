<?php
require_once("nav.php");
if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
}
?>
<form action="<?php echo FRONT_ROOT."JobOffer/Add"?>" method="post">
    <br>
    <select class="form-control" id="company" name="idCompany">
        <?php foreach($companyList as $company){?>
            <option value=<?php echo $company->getIdCompany();?>><?php echo $company->getCompanyName();?></option>
        <?php } ?>
    </select>
    <br>


    <!--<input type="submit" value="ADD"> -->
    <br>
    <button type="submit" class="btn" >Add</button>
    <!--<button type="submit" name="" class="btn" value="" formaction="<?php echo FRONT_ROOT."Company/ShowListView" ?>" > Back </button> -->
    <div style="display: inline-block; margin:auto" class="alert alert-<?php echo $alert->getType()?>" role="alert">
        <?php echo $alert->getMessage(); ?>
    </div>
</form>
<?
$_SESSION['alert'] = null;
?>