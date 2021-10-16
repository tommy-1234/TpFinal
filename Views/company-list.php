<?php
require_once("nav.php");
echo "Se ha logeado correctamente, aca falta desarrollar la lista de compañias";
?>
<form action="<?php echo FRONT_ROOT."Company/Remove"?>" method="post">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style ="width: 15%;">name</th>
              <th style="width: 15%;">descr</th>
              <th style="width: 30%;">email</th>
              <th style="width: 30%;">phone</th>
              <th style="width: 15%;">linkedn</th>
              <th style="width: 15%;">adrress</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
          <tbody>     
                <?php foreach($companyList as $company){?>
                  <tr>
                    <td><?php echo $company->getCompanyName();?>
                    <td><?php echo $company->getCompanyDescription();?></td>
                    <td><?php echo $company->getCompanyEmail();?></td>
                    <td><?php echo $company->getCompanyPhone();?></td>
                    <td><?php echo $company->getCompanyLinkedin();?></td>
                    <td><?php echo $company->getCompanyAddress();?></td>
                    <!-- Agregar boton para mandar ID y borrarlo -->
                  </tr>
                  <?php }?>
          </tbody>
        </table></form> 

