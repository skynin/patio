<?php

namespace common;

use Psr\Container\{ContainerInterface, NotFoundExceptionInterface, ContainerExceptionInterface};

/**
 * Easy implementation of DI container
 *
 * @author skynin
 */
class EasyContainer implements ContainerInterface {

  private $box = [];

  function __construct() {}

  public function set(string $id, callable $init): void {
    $this->box[$id] = [
        'obj' => null, // last created object
        'create' => $init
    ];
  }

  public function get(string $id) {
    if (!$this->has($id)) throw new ExDi(print_r([
        $id => array_keys($this->box)
    ]), 1);

    try {
      return $this->box[$id]['obj'] = ($this->box[$id]['create'])($this);
    } catch (\Exception $eX) {
      throw new ExDi($id, 2, $eX);
    }
  }

  public function has(string $id): bool {
    return key_exists($id, $this->box);
  }
}

class ExDi extends \Exception implements ContainerExceptionInterface, NotFoundExceptionInterface {}