<?php
require_once("nav.php");
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
        <form enctype="multipart/form-data" action="<?php echo FRONT_ROOT."JobRequest/Postulation" ?>" method="post">
            <input type="file" name="newFile" accept="application/pdf">
            <button type="submit">Send</button>
        </form>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>