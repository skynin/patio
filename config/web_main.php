<?php

$webRoot = realpath(__DIR__. '/../www') . '/';

$defa = [
  'WEB_ROOT' => $webRoot,
  'DIR_ORIG' => "{$webRoot}photo/orig/",
  'DIR_THUMB' => "{$webRoot}photo/thumb/"
];

$local = [];
$localName = __DIR__ . '/web_local.php';
if (file_exists($localName)) $local = require_once $localName;

return array_merge_recursive ($defa, $local);

/*
Example web_local.php:

<?php
use Idearia\Logger;

Logger::$log_level = 'debug';

return [];
*/
