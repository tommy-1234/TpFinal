<?php
require_once('nav.php');
?>
<form action="<?php echo FRONT_ROOT."Company/Update"?>" method="post">
    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Company Description</th>
                <th>Company Email</th>
                <th>Company phone</th>
                <th>Company Linkedin</th>
                <th>Company Address</th>
                <th></th>
            </tr>
        </thead>
        <tbody align="center">
            <td><input type="text" name="companyName" id="Name"></td>
            <td><input type="textarea" name="companyDescription" id="Desc"></td>
            <td><input type="email" name="companyEmail" id="Email"></td>
            <td><input type="number" name="companyPhone" id="Number"></td>
            <td><input type="text" name="companyLinkedin" id="Linkedin"></td>
            <td><input type="text" name="companyAddress" id="Address"></td>
        </tbody>
    </table>
    <input type="submit" value="Modificar">
</form>
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
</script>