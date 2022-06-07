<?php

namespace common;

use common\Photo;

/**
1.txt

Название альбома
Харьков; Змиев; Сев. Донец;
Описание альбома

%@photos Информация к каждой фотографии

имя.файла;@top;@front

%@post

# Текст к альбому

В формате markdown
 * @property string[] $tags
 * @property Photo[] $photos
 * @author skynin
 */
class Album {
  public string $id;
  public string $year;
  public string $title;
  public array $tags = [];
  public string $description;
  public array $photos = [];
  private array $_photoInfos = [];
  public string $post;
  
  public const I_NAME = '1.txt';

  public function frontPhoto() {
    $front = reset($this->photos);

    // return '6/5515/9199788659_818383d0b8_k.jpg';

    return $front->front();
  }

  public function __construct($idA, $dir, $year) {

    $this->id = $idA;
    $this->year = $year;

    $allFiles = scandir($dir);
    
    $this->title = hash('adler32', $dir);

    $this->initI($dir . self::I_NAME);

    foreach ($allFiles as $fl) {
      if ($fl[0] == '.' || $fl == self::I_NAME) continue;

      $this->photos[$fl] = new Photo($fl, $this, $this->_photoInfos[$fl] ?? []);
    }
  }
  private function initI($fullName) {

    if (!file_exists($fullName)) return;

    $row = 0;
    $mode = '';
    $flH = fopen($fullName, 'r');

    while ($strI = fgets($flH) !== false) {
      ++$row;
      
      if (empty($strI)) continue;
      if ($strI[0] == '-' && $strI[1] == '-') continue;

      if ($row < 4) {
        switch ($row) {
          case 1:
            $this->title = trim($strI);
            break;
          case 2:
            $this->tags = array_map('trim', explode(';', $strI));
            break;
          case 3:
            $this->description = trim($strI);
            break;

          default:
            break;
        }
        continue;
      }

      if (str_starts_with($strI, '%@photos')) {
        $mode = 'photos';
        continue;
      }
      else if (str_starts_with($strI, '%@post')) {
        $mode = 'post';
        $this->post = '';
        continue;
      }

      switch ($mode) {
        case 'photos':
          $arr = array_map('trim', explode(';', $strI));
          $fName = array_shift($arr);
          $this->_photoInfos[$fName] = $arr;
          break;
        case 'post':
          $this->post .= $strI;
      }
    }

    fclose(flH);
  }

  public static function createID($yea, $name) {
    return  $yea . '/' . $name . '/';
  }
}
