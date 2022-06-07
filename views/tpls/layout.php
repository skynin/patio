<?php
/** @var League\Plates\Template $this */

global $VERSION;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="photo gallery"
    />
    <title><?=$this->e($title)?></title>

<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/buttons-min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/grids-responsive-min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/menus-min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/patio.css?v=<?=$VERSION?>">
  </head>
  <body>
    <div>
    <?=$this->insert('menu')?>
    <div class="pure-g"><?=$this->section('content')?></div>
    <?=$this->insert('footer')?>
    </div>
  </body>
</html>