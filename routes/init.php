<?php

use League\Plates\Engine as PlateEngine;
use Psr\Container\ContainerInterface;
use routes\HomeController;
use common\AlbumsIndex;
use Slim\App;
use Middlewares\TrailingSlash;
use Idearia\Logger;
use Slim\Middleware\ErrorMiddleware;

AppDIset(HomeController::class, function (ContainerInterface $container) {
  // return new HomeController($container->get(PlateEngine::class), $container->get(AlbumsIndex::class));
  static $singleton = null;
  if ($singleton) return $singleton;
  return $singleton = new HomeController($container->get(PlateEngine::class), $container->get(AlbumsIndex::class));
});

/* Routing */

function initRoutes(App $APP) {

  $APP->addRoutingMiddleware();

  $APP->add(new TrailingSlash(true));

  $APP->get('/photo/{yea}/{name}/{number}/', HomeController::class .':photo');
  $APP->get('/album/{yea}/{name}/', HomeController::class .':album');
  $APP->get('/', HomeController::class .':index');

  $errorMiddleware = $APP->addErrorMiddleware(Logger::$log_level == 'debug', true, true, new Idearia\PS3Logger());

  $defaHandler = $errorMiddleware->getDefaultErrorHandler();

  // Define Custom Error Handler
  $customErrorHandler = function (
      $request,
      \Throwable $exception,
      bool $displayErrorDetails,
      bool $logErrors,
      bool $logErrorDetails,
      ?LoggerInterface $logger = null
  ) use ($APP, $defaHandler) {
    Logger::error($_SERVER,'SERVER');
    if (!empty($_REQUEST)) Logger::error($_REQUEST,'$REQUEST');
    if (!empty($_POST)) Logger::error($_POST,'POST');
    return $defaHandler($request, $exception, $displayErrorDetails, $logErrors, $logErrorDetails);
  };
  $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
}

