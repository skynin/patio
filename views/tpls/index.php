<?php

use common\Album;

/** @var League\Plates\Template $this */

?>
<?php $this->layout('layout') ?>

<?php foreach ($albums as $idA =>$album):
   /** @var Album $album */
  $this->insert('part/alb_front',['album' => $album, 'idA' => $idA]);
  ?>
<?php endforeach;
