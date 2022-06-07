<?php

namespace config;

/**
 * @property string $WEB_ROOT
 * @property string $DIR_ORIG
 * @property string $DIR_THUMB
 *
 * @author skynin
 */
class Config {

  private $conf;

  public function __construct(array $arrConf) {
    $this->conf = $arrConf;
  }

  public function __isset(string $name) : bool {
    return key_exists($name, $this->conf);
  }

  public function __get($name) {
    return isset($this->$name) ? $this->conf[$name] : null;
  }
}
