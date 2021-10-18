<?php
require_once("nav.php");
if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
}
?>
<form action="<?php echo FRONT_ROOT."Company/Add"?>" method="post">
    <br>
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
    <!--<input type="submit" value="ADD"> -->
    <br>
    <button type="submit" class="btn" >Add</button>
    <button type="submit" name="" class="btn" value="" formaction="<?php echo FRONT_ROOT."Company/ShowListView" ?>" > Back </button>
    <div style="display: inline-block; margin:auto" class="alert alert-<?php echo $alert->getType()?>" role="alert">
        <?php echo $alert->getMessage(); ?>
    </div>
</form>
<?
$_SESSION['alert'] = null;
?>