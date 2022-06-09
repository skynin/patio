<?php
use routes\URLs;

$thumbPhoto = $photo->thumb();

if ($thumbPhoto):
?>
<div class="pure-u-sm-1-5 pure-u-md-1-6 pure-u-lg-1-8 pure-u-xl-1-12 pure-u-xxl-1-24">  
  <a href="<?= URLs::origPhoto($photo->orig()) ?>">
    <img src="<?= URLs::thumbPhoto($thumbPhoto) ?>" alt="thumbPhoto">
  </a>
</div>
<?php
endif;
