<?php

namespace PdfBuilder\Structure;

use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Numeric;
use PdfBuilder\Type\Reference;

class Trailer extends PdfPart
{
  private $settings;
  private $xrefOffset;

  public function __construct(Numeric $xrefCount, Reference $root, int $xrefOffset)
  {
    $this->settings = new Dictionary(
      [
        'Size' => $xrefCount,
        'Root' => $root
      ]
    );
    $this->xrefOffset = $xrefOffset;
  }

  public function toString()
  {
    $text = "trailer\n";
    $text .= $this->settings->toString()."\n";
    $text .= "startxref\n";
    $text .= $this->xrefOffset . "\n";
    $text .= "%%EOF\n";
    return $text;
  }
}