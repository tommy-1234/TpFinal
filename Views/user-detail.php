<?php 
 include('nav.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Company/ShowListView" ?>" method="">
        <table style="text-align:center;">
          <tbody>
                  <tr>
                    <td><?php echo "First Name :" ?></td>
                    <td><?php echo $user->getFirstName() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "Last Name :" ?></td>
                    <td><?php echo $user->getLastName() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "DNI :" ?></td>
                    <td><?php echo $user->getDni() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "File Number :" ?></td>
                    <td><?php echo $user->getFileNumber() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "Gender :" ?></td>
                    <td><?php echo $user->getGender() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "Birth Day :" ?></td>
                    <td><?php echo $user->getBirthDate() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "eMail :" ?></td>
                    <td><?php echo $user->getEmail() ?></td>
                  </tr>
                  <tr>
                    <td><?php echo "Phone Number :" ?></td>
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