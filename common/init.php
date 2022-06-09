<?php

use Psr\Container\ContainerInterface;
use config\Config;
use common\AlbumsIndex;

AppDIset(AlbumsIndex::class, function (ContainerInterface $container) {
  static $singleton = null;
  if ($singleton) return $singleton;
  return $singleton = new AlbumsIndex($container->get(Config::class));
});

function img_resize($newWidth, $targetFile, $originalFile) {

  $info = getimagesize($originalFile);
  $mime = $info['mime'];

  switch ($mime) {
    case 'image/jpeg':
      $image_create_func = 'imagecreatefromjpeg';
      $image_save_func = 'imagejpeg';
      $new_image_ext = 'jpg';
      break;

    case 'image/png':
      $image_create_func = 'imagecreatefrompng';
      $image_save_func = 'imagepng';
      $new_image_ext = 'png';
      break;

    case 'image/gif':
      $image_create_func = 'imagecreatefromgif';
      $image_save_func = 'imagegif';
      $new_image_ext = 'gif';
      break;

    default:
      throw new Exception('Unknown image type.');
  }

  $img = $image_create_func($originalFile);
  list($width, $height) = getimagesize($originalFile);

  $newHeight = ($height / $width) * $newWidth;
  $tmp = imagecreatetruecolor($newWidth, $newHeight);
  imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

  if (file_exists($targetFile)) {
    unlink($targetFile);
  }

  createDirsForFile($targetFile);

  $new_image_ext = strpos($targetFile, '.') ? '' : ('.'.$new_image_ext);

  $image_save_func($tmp, $targetFile . $new_image_ext);
}

function createDirsForFile($targetFile) {
  $fullDirName = dirname($targetFile);
  if (is_dir($fullDirName)) return;
  mkdir($fullDirName,0777,true);
}

function prefixHash(string $prefix, $data, $saveExt = '.') {
  if (!is_string($data)) $data = serialize ($data);

  $ext = '';
  if ($saveExt) {
    $posLast = strrpos($data, $saveExt, -1);
    if ($posLast) {
      $ext = substr($data, $posLast);
      $data = substr($data, 0, $posLast);
    }
  }
  
  return $prefix . hash('md4', $data) . $ext;
}
