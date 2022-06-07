<?php

use Idearia\Logger;

use Psr\Container\ContainerInterface;
use config\Config;

global $VERSION;
$VERSION = '0.0.1';

Logger::$log_dir = realpath(__DIR__ . '/../runtime');
Logger::$log_file_name = 'patio';
Logger::$log_file_extension = 'log';
Logger::$write_log = true;
Logger::$print_log = false;
Logger::$log_level = 'warning';

$confData = require_once __DIR__.'/web_main.php';
global $AppConfig;
$AppConfig = new Config($confData);

AppDIset(Config::class, function (ContainerInterface $container) use ($AppConfig) {
  return $AppConfig;
});
