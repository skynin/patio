<?php

use common\{Album, Photo};

/** @var Album $album */

$photos = $album->photos;

?>
<?php $this->layout('layout') ?>

<?php foreach ($photos as $photo):
   /** @var Photo $photo */
  $this->insert('part/pht_thumb',['photo' => $photo]);
  ?>
<?php endforeach;




