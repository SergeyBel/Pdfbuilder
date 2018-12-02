<?php

namespace PdfBuilder\Object;

use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Name;
use PdfBuilder\Type\Numeric;
use PdfBuilder\Type\Stream;

class Image implements Element
{
  private $width;
  private $height;
  private $colorSpace;
  private $bitsPerComponent;
  private $filter;
  private $data;

  /**
   * Image constructor.
   * @param $width
   * @param $height
   * @param $colorSpace
   * @param $bitsPerComponent
   * @param $filter
   * @param $data
   */
  public function __construct($width, $height, $colorSpace, $bitsPerComponent, $filter, $data)
  {
    $this->width = $width;
    $this->height = $height;
    $this->colorSpace = $colorSpace;
    $this->bitsPerComponent = $bitsPerComponent;
    $this->filter = $filter;
    $this->data = $data;
  }


  public function toType()
  {
    $options = new Dictionary(
      [
        'Type' => new Name('XObject'),
        'Subtype' => new Name('Image'),
        'Width' => new Numeric($this->width),
        'Height' => new Numeric($this->height),
        'ColorSpace' => new Name($this->colorSpace),
        'BitsPerComponent' => new Numeric($this->bitsPerComponent),
        'Filter' => new Name($this->filter),
      ]
    );
    return new Stream($this->data, $options);
  }
}