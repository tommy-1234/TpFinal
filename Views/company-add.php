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

      <form action="<?php echo FRONT_ROOT."Company/Add"?>" method="post">
        <br>
        <table style="text-align:left;" class="table table-bordered">
          <tbody>  
                <tr>
                  <td style="font-weight:bold;" >Name</td>
                  <td><input type="text" name="companyName" id="Name" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Description</td>
                  <td><input type="textarea" name="companyDescription" id="Desc" size="80" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Email</td>
                  <td><input type="email" name="companyEmail" id="Email" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Phone</td>
                  <td><input type="number" name="companyPhone" id="Number" required></td>
               </tr>
                <tr>
                  <td style="font-weight:bold;">Linkedin</td>
                  <td><input type="text" name="companyLinkedin" id="Linkedin" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Address</td>
                  <td><input type="text" name="companyAddress" id="Address" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Link</td>
                  <td><input type="text" name="companyLink" id="Link" required></td>
                </tr>
         </tbody>
        </table>


    <!--<input type="submit" value="ADD"> -->
    <br>
    <button type="submit" class="btn" >Add</button>
    
    <div style="display: inline-block; margin:auto" class="alert alert-<?php echo $alert->getType()?>" role="alert">
        <?php echo $alert->getMessage(); ?>
    </div>
</form>
<?
$_SESSION['alert'] = null;
?>