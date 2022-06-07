<?php

namespace common;

use config\Config;
use common\Album;

/**
 * Description of AlbumsIndex
 *
 * @author skynin
 */
class AlbumsIndex {
  public static $DIR_ORIG = 'photo/orig';
  public static $DIR_THUMB = 'photo/thumb';

  public $all;

  public function __construct(Config $config) {
    self::$DIR_ORIG = $config->DIR_ORIG;
    self::$DIR_THUMB = $config->DIR_THUMB;
  }

  /**
   *
   * @return Album[]
   */
  public function index() : array {

    $result = [];

    $allYears = scandir(self::$DIR_ORIG);
    if (empty($allYears)) return [];

    foreach ($allYears as $year) {

      if ($year[0] == '.') continue;

      if (!is_dir(self::$DIR_ORIG . $year)) continue;

      $yearAlbums = scandir(self::$DIR_ORIG . $year);
      if (empty($yearAlbums)) continue;

      foreach ($yearAlbums as $album) {
        if ($album[0] == '.') continue;

        $albFullPath = self::$DIR_ORIG . $year . '/' . $album . '/';
        if (!is_dir($albFullPath)) continue;

        $idA = Album::createID($year, $album);

        $result[$idA] = new Album($idA, $albFullPath, $year);
      }
    }

    krsort($result);

    return $this->all = $result;
  }

  public function album($idA) : ?Album {
    if (empty($this->all)) $this->index();

    if (key_exists($idA, $this->all)) return $this->all[$idA];

    return null;
  }
}
