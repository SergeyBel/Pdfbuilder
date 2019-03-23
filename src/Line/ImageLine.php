<?php

namespace PdfBuilder\Line;

use PdfBuilder\Type\Name;

class ImageLine implements Line
{
  private $id;
  private $x;
  private $y;
  private $width;
  private $height;

  public function __construct(string $id, float $width, float $height, float $x, float $y)
  {
    $this->id = $id;
    $this->width = $width;
    $this->height = $height;
    $this->x = $x;
    $this->y = $y;
  }

  public function toString()
  {
    $data = "q\n";
    $data .= $this->width." 0 0 ".$this->height." ".$this->x." ".($this->y - $this->height)." cm\n";
    $data .= (new Name($this->id))->toString()." Do\n";
    $data .= "Q\n";
    return $data;
  }
}