<?php

namespace PdfBuilder\Object;

use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Name;

class Font implements Element
{
  private $fontName;

  public function __construct(string $fontName)
  {
    $this->fontName = $fontName;
  }

  public function toType()
  {
    return  new Dictionary(
      [
        'Type' => new Name('Font'),
        'Subtype' => new Name('Type1'),
        'BaseFont' => new Name($this->fontName)
      ]
    );
  }
}