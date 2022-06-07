<?php

namespace routes;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use League\Plates\Engine as PlateEngine;
use common\{AlbumsIndex, Album};

/**
 * Description of HomeController
 *
 * @author skynin
 */
class HomeController {

  private PlateEngine $temgine;
  private AlbumsIndex $albums;

  function __construct(PlateEngine $temgine, AlbumsIndex $albums) {
    $this->temgine = $temgine;
    $this->albums = $albums;
  }

  public function index(Request $request, Response $response) {
    $this->temgine->addData(['title'=>'Patio']);

    $response->getBody()->write($this->temgine->render('index', [
        'content'=>'<p>Hello world from Patio!</p>',
        'albums' => $this->albums->index()
        ]) );
    return $response;
  }

  public function album(Request $request, Response $response, $args) {

    $this->temgine->addData(['title'=>'Patio']);

    $idA = Album::createID($args['yea'], $args['name']);

    $alb = $this->albums->album($idA);
    if (empty($alb)) {
      $response->getBody()->write($this->temgine->render('404', [
          'content'=>"album: $idA not found"]) );      
      return $response->withStatus(404);
    }   

    $response->getBody()->write($this->temgine->render('album', ['album'=>$alb]) );
    return $response;
  }
  public function photo(Request $request, Response $response, $args) {

    $this->temgine->addData(['title'=>'Patio']);

    $response->getBody()->write($this->temgine->render('album', ['content'=>"photo: {$args['yea']} {$args['name']}"]) );
    return $response;
  }

  
}
