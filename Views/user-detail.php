<?php 
 include('nav.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Company/ShowListView" ?>" method="">
        <br>
        <table style="text-align:center; " class="table table-bordered">
          <tbody>
                  <tr>
                    <td style="font-weight:bold;">First Name :</td>
                    <td><?php echo $user->getFirstName() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">Last Name :</td>
                    <td><?php echo $user->getLastName() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">DNI :</td>
                    <td><?php echo $user->getDni() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">File Number :</td>
                    <td><?php echo $user->getFileNumber() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">Gender :</td>
                    <td><?php echo $user->getGender() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">Birth Day :</td>
                    <td><?php echo $user->getBirthDate() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">eMail :</td>
                    <td><?php echo $user->getEmail() ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">Phone Number :</td>
                    <td><?php echo $user->getPhoneNumber() ?></td>
                  </tr>
          </tbody>
        </table>
        <button type="submit" name="id" class="btn" value=""> Back </button>
      </form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>