<?php 
    include_once('header.php');
?>

<div class="text-center">
    <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post" class="form-signin">
      <img class="mb-4" src=" <?php echo IMG_PATH ?>bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="userEmail" class="form-control" placeholder="Email address" required autofocus>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>
   
