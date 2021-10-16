<?php
require_once('nav.php');
?>

<form action="<?php FRONT_ROOT."Company/Update"?>" method="post">
    <input type="text" name="companyName" id="Name">
    <input type="textarea" name="companyDescription" id="Desc">
    <input type="email" name="companyEmail" id="Email">
    <input type="number" name="companyNumber" id="Number">
    <input type="text" name="companyLinkedin" id="Linkedin">
    <input type="text" name="companyAdrress" id="Adrress">
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
    document.getElementById("Adrress").value = companyDesc;
</script>