<?php 
    include_once('header.php');
?>

<div class="text-center">
    <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post" class="form-signin">
      <img class="mb-4" src=" <?php echo IMG_PATH ?>bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="userEmail" class="form-control" placeholder="Email address" autofocus>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <br>
      <br>
      <div style="display: inline-block; margin:auto">
           <?php echo $message ?>
      </div>
    </form>
    <form action="<?php echo FRONT_ROOT."Company/ShowAddView" ?>" method="post" class="form-signin">
      <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Register as student</button>   -->
      <button class="btn btn-lg btn-primary btn-block" type="submit" formaction="<?php echo FRONT_ROOT."Company/ShowRegisterView" ?>">Register as company</button>
    </form>
</div>