<?php
use Slim\Factory\AppFactory;
use Slim\App;
use common\EasyContainer;

require_once __DIR__ . '/vendor/autoload.php';
spl_autoload_register(function ($class_name) {
  static $paths = ['/','/common/'];

  $tempfullName = __DIR__ . '%s' . str_replace('\\', '/', $class_name)  . '.php';

  foreach ($paths as $s) {
    $fullName = sprintf($tempfullName, $s);
    if (file_exists($fullName)) {
      require_once $fullName;
      return;
    }
  }
});

AppFactory::setContainer(new EasyContainer());

/** @var App $APP */
global $APP;
$APP = AppFactory::create();

/* DI */
function AppDIset(string $nameProp, callable $func) {
  global $APP;
  $container = $APP->getContainer();

  $container->set($nameProp, $func);
}
function AppDIget(string $nameProp) {
  global $APP;
  $container = $APP->getContainer();

  return $container->get($nameProp);
}

require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/views/init.php';
require_once __DIR__ . '/common/init.php';
require_once __DIR__ . '/routes/init.php';

function runPatio(App $APP) {

  initRoutes($APP);

  $APP->run();
}

runPatio($APP);
