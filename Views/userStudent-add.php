<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">

      <form action="<?php echo FRONT_ROOT."User/CheckMail"?>" method="post">
        <br>
        <table style="text-align:left;" class="table table-bordered">
          <tbody>  
                <tr>
                  <td style="font-weight:bold;" >Email</td>
                  <td><input type="email" name="email" id="" required></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Password</td>
                  <td><input type="password" name="password" id="" required></td>
                </tr>
         </tbody>
        </table>
    <br>
        <button type="submit" class="btn" >Register User</button>
    </form>
    </div>
  </div>
</div>