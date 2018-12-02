<?php

namespace PdfBuilder\Pdf;


class PdfIndent
{
  private $x;
  private $y;
  public function __construct($dx, $dy)
  {
    $this->x = $dx;
    $this->y = $dy;
  }

  /**
   * @return mixed
   */
  public function getX()
  {
    return $this->x;
  }

  /**
   * @return mixed
   */
  public function getY()
  {
    return $this->y;
  }
}