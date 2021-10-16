<?php 
    include_once('header.php');
?>
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <div id="logo" class="fl_left">
      <h1>WELCOME</h1>
    </div>
  </header>
</div>

<div class="wrapper row3 img-login">
  <div class="div-login"><br>
    <h1 class="text-login">LOGIN TO MANAGE</h1>
</div>
  <div class="div-login">  
    <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post">
        <input class="input-login" type="text" name="userEmail" placeholder="User Email" required>
        <button class="btn-login btn" type="submit" name="">Login</button>
      </form>
  </div>
</div>
