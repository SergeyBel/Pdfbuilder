<?php

namespace PdfBuilder\Pdf;

class PdfFont
{
  const SIZE_SCALE_FACTOR = 1000;
  protected $name;
  protected $size;
  protected $widthTable;

  public function __construct($name, $size)
  {
    $this->name = $name;
    $this->size = $size;
  }

  public function textWidth($text)
  {
    $width = 0;
    $length = strlen($text);
    for ($i = 0; $i < $length; $i++)
      $width += $this->widthTable[$text[$i]];
    return $width * $this->size / self::SIZE_SCALE_FACTOR;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getSize()
  {
    return $this->size;
  }
}