<?php
require_once("nav.php");
?>
<form action="<?php echo FRONT_ROOT."Company/Add"?>" method="post">
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
            <td><input type="text" name="companyName" required></td>
            <td><input type="textarea" name="companyDescription" required></td>
            <td><input type="email" name="companyEmail" required></td>
            <td><input type="number" name="companyPhone" required></td>
            <td><input type="text" name="companyLinkedin" required></td>
            <td><input type="text" name="companyAddress" required></td>
        </tbody>
    </table>
    <input type="submit" value="AGREGAR">
</form>