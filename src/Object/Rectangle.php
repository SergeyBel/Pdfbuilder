<?php

namespace PdfBuilder\Object;

use PdfBuilder\Type\Numeric;
use PdfBuilder\Type\Vector;

class Rectangle implements Element
{
  private $lowLeftX;
  private $lowLeftY;
  private $upperRightX;
  private $upperRightY;

  public function __construct($lowLeftX, $lowLeftY, $upperRightX, $upperRightY)
  {
    $this->lowLeftX = $lowLeftX;
    $this->lowLeftY = $lowLeftY;
    $this->upperRightX = $upperRightX;
    $this->upperRightY = $upperRightY;
  }

  public function toType()
  {
    return new Vector(
      [
        new Numeric($this->lowLeftX),
        new Numeric($this->lowLeftY),
        new Numeric($this->upperRightX),
        new Numeric($this->upperRightY),
      ]
    );
  }
}