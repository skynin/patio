<?php

use Psr\Container\ContainerInterface;
use League\Plates\Engine as PlateEngine;

AppDIset(PlateEngine::class, function (ContainerInterface $container) {
  static $singleton = null;
  if ($singleton) return $singleton;
  return $singleton = new PlateEngine(__DIR__.'/tpls');
});
