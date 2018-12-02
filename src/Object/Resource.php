<?php

namespace PdfBuilder\Object;

use PdfBuilder\Structure\BodyObject;
use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Reference;

class Resource implements Element
{
  private $fonts;
  private $images;

  public function __construct()
  {
    $this->fonts = [];
    $this->images = [];
  }

  public function toType()
  {
    $fontsData = [];
    foreach ($this->fonts as $key => $font)
    {
      $fontsData[$key] = new Reference($font);
    }

    $imagesData = [];
    foreach($this->images as $key=>$image)
    {
      $imagesData[$key] = new Reference($image);
    }
    return new Dictionary(
      [
        'Font' => new Dictionary($fontsData),
        'XObject' => new Dictionary($imagesData)
      ]
    );
  }

  public function addFont($fontId, BodyObject $font)
  {
    $this->fonts[$fontId] = $font;
  }

  public function addImage($imageId, BodyObject $image)
  {
    $this->images[$imageId] = $image;
  }
}