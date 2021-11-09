<?php
require_once('nav.php');
?>

<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">

      <form action="<?php echo FRONT_ROOT."Company/Update"?>" method="post">
        <br>
        <table style="text-align:left;" class="table table-bordered">
          <tbody>  
                <tr>
                  <td style="font-weight:bold;" >Name</td>
                  <td><input type="text" name="companyName" id="Name"></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;" >Description</td>
                  <td><input type="textarea" name="companyDescription" id="Desc" size="80"></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Email</td>
                  <td><input type="email" name="companyEmail" id="Email"></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Phone</td>
                  <td><input type="number" name="companyPhone" id="Number"></td>
               </tr>
                <tr>
                  <td style="font-weight:bold;">Linkedin</td>
                  <td><input type="text" name="companyLinkedin" id="Linkedin"></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Address</td>
                  <td><input type="text" name="companyAddress" id="Address"></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">Link</td>
                  <td><input type="text" name="companyLink" id="Link"></td>
                </tr>
         </tbody>
        </table>

        <table>
            <tbody>
                <td>
                    <input type="submit" value="Modify">
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


<script>
    var companyName = "<?php echo $company->getCompanyName()?>";
    document.getElementById("Name").value = companyName;
    var companyDesc = "<?php echo $company->getCompanyDescription()?>";
    document.getElementById("Desc").value = companyDesc;
    var companyDesc = "<?php echo $company->getCompanyEmail()?>";
    document.getElementById("Email").value = companyDesc;
    var companyDesc = "<?php echo $company->getCompanyPhone()?>";
    document.getElementById("Number").value = companyDesc;
    var companyDesc = "<?php echo $company->getCompanyLinkedin()?>";
    document.getElementById("Linkedin").value = companyDesc;
    var companyDesc = "<?php echo $company->getCompanyAddress()?>";
    document.getElementById("Address").value = companyDesc;
    var companyDesc = "<?php echo $company->getCompanyLink()?>";
    document.getElementById("Link").value = companyDesc;
</script>