<?php

namespace routes;

/**
 * Description of URLs
 *
 * @author skynin
 */
class URLs {
  public static function urlAlbum($idA) {
    return '/album/'.$idA;
  }

  public static function thumbPhoto($photo) {
    //return 'https://c2.staticflickr.com/'.$photo;
    return '/photo/thumb/'.$photo;
  }
  public static function origPhoto($photo) {    
    return '/photo/orig/'.$photo;
  }
}
