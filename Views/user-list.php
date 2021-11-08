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
              <th style ="width: 20%;">Student ID</th>
              <th style ="width: 20%;">Career ID</th>
              <th style ="width: 20%;">First Name</th>
              <th style ="width: 20%;">Last Name</th>
              <th style ="width: 20%;">DNI</th>
              <th style ="width: 20%;">File Number</th>
              <th style ="width: 20%;">Gender</th>
              <th style ="width: 20%;">Birthdate</th>
              <th style ="width: 20%;">Email</th>
              <th style="width: 20%;">Phone Number</th>
              <th style ="width: 20%;">Active</th>
            </tr>
          </thead>
          <tbody>     
                <?php foreach($studentList as $student){?>
                  <tr>
                    <td><?php echo $student->getStudentId();?></td>
                    <td><?php echo $student->getCareerId();?></td>
                    <td><?php echo $student->getFirstName();?></td>
                    <td><?php echo $student->getLastName();?></td>
                    <td><?php echo $student->getDni();?></td>
                    <td><?php echo $student->getFileNumber();?></td>
                    <td><?php echo $student->getGender();?></td>
                    <td><?php echo $student->getBirthDate();?></td>
                    <td><?php echo $student->getEmail();?></td>
                    <td><?php echo $student->getPhoneNumber();?></td>
                    <td><?php if($student->getActive() == 1){  
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