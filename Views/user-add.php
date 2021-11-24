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

      <form action="<?php echo FRONT_ROOT."User/Add"?>" method="post">
        <br>
        <table style="text-align:left;" class="table table-bordered">
          <tbody>  
                <tr>
                    <td style="font-weight: bold;">Carrer</td>
                    <td><select name="carrer" id="carrer">
                        <option value="1">Navel engineering</option>
                        <option value="2">Fishing engineering</option>
                        <option value="3">University technician in programming</option>
                        <option value="4">University technician in computer systems</option>
                        <option value="5">University technician in textile production</option>
                        <option value="6">University technician in administration</option>
                        <option value="7">Bachelor in environmental management</option>
                        <option value="8">University technician in environmental proced</option>
                    </select></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Student first name</td>
                  <td><input type="text" name="studentFirstName" id="Firstname" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Student last name</td>
                  <td><input type="text" name="studentLastName" id="Lastname" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Student DNI</td>
                  <td><input type="text" name="studentDni" id="dni" required></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Student file number</td>
                    <td><input type="text" name="studentFileNumber" id="fileNumber" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Student Phone</td>
                  <td><input type="number" name="studentPhone" id="Number" required></td>
               </tr>
                <tr>
                  <td style="font-weight:bold;">Student gender</td>
                  <td><select type="text" name="studentGender" id="gender" required>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Non-binary">Non-binary</option>
                  </select></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Student birthdate</td>
                  <td><input type="date" name="studentBirthDate" id="birthDate" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Student email</td>
                  <td><input type="email" name="studentEmail" id="email" required></td>
                </tr>
         </tbody>
        </table>

    <br>
    <button type="submit" class="btn" >Add</button>
    
    <div style="display: inline-block; margin:auto" class="alert alert-<?php echo $alert->getType()?>" role="alert">
        <?php echo $alert->getMessage(); ?>
    </div>
</form>
<?
$_SESSION['alert'] = null;
?>