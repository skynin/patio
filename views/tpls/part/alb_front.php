<?php
use common\Album;
use routes\URLs;

/** @var Album $album */

$frontPhoto = $album->frontPhoto();

if ($frontPhoto):
?>
<div class="photo-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
  <a href="<?= URLs::urlAlbum($idA) ?>">
    <img src="<?= URLs::thumbPhoto($frontPhoto) ?>" alt="frontPhoto">
  </a>

  <aside class="photo-box-caption">
    <span>      
      <a href=<?= URLs::urlAlbum($idA) ?>><?= $album->year ?> <?= $album->title ?></a>
    </span>
  </aside>
</div>
<?php
endif;
