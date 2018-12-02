<?php

namespace PdfBuilder\Object;

use PdfBuilder\Structure\BodyObject;
use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Name;
use PdfBuilder\Type\Reference;

class Catalog implements Element
{
  private $pages;
  public function __construct(BodyObject $pages)
  {
    $this->pages = $pages;
  }

  public function toType()
  {
    return new Dictionary(
      [
        'Type' => new Name('Catalog'),
        'Pages' => new Reference($this->pages)
      ]
    );
  }
}