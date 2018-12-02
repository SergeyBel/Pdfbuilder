<?php

namespace PdfBuilder\Pdf;


class PdfPiece
{
  private $parts;

  public function __construct()
  {
    $this->parts = [];
  }

  public function addPart($piece)
  {
    $this->parts[] = $piece;
    return $this;
  }

  public function getParts()
  {
    return $this->parts;
  }
}