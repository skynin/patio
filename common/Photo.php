<?php
namespace common;

use common\Album;

/**
 * @property string[] $tags
 *
 * @author skynin
 */
class Photo {
  public string $fileName;
  public array $tags;
  public Album $album;

  public static int $SIZE_FRONT = 700;
  public static int $SIZE_THUMB = 120;

  public function __construct(string $fName, Album $album, array $tags) {
    $this->album = $album;
    $this->fileName = $fName;
    $this->tags = $tags;
  }

  public function front() {

    $hName = prefixHash('f', $this->fileName);
    
    $shortSample = $this->album->id . $hName;

    $frontSample = AlbumsIndex::$DIR_THUMB . $shortSample;
    $origImage = AlbumsIndex::$DIR_ORIG . $this->album->id . $this->fileName;

    if (!file_exists($frontSample)) {
      img_resize(self::$SIZE_FRONT, $frontSample, $origImage);
    }

    return $shortSample;
  }

  public function thumb() {

    $hName = prefixHash('t', $this->fileName);

    $shortSample = $this->album->id . $hName;

    $thumbSample = AlbumsIndex::$DIR_THUMB . $shortSample;
    $origImage = AlbumsIndex::$DIR_ORIG . $this->album->id . $this->fileName;

    if (!file_exists($thumbSample)) {
      img_resize(self::$SIZE_THUMB, $thumbSample, $origImage);
    }

    return $shortSample;
  }

  public function orig() {
    $shortSample = $this->album->id . $this->fileName;
    return $shortSample;
  }
}
