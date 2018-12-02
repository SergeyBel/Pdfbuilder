<?php

namespace PdfBuilder\Object;

use PdfBuilder\Structure\BodyObject;
use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Name;
use PdfBuilder\Type\Numeric;
use PdfBuilder\Type\Reference;
use PdfBuilder\Type\Vector;

class Pages implements Element
{
  private $kids;
  private $mediaBox;

  public function __construct(array $kids, Rectangle $mediaBox)
  {
    $this->kids = $kids;
    $this->mediaBox = $mediaBox;
  }

  public function addKid(BodyObject $kid)
  {
    $this->kids[] = $kid;
  }

  public function toType()
  {
    $kidsVector = [];
    foreach ($this->kids as $kid)
      $kidsVector[] = new Reference($kid);
    return new Dictionary(
      [
        'Type' => new Name('Pages'),
        'MediaBox' => $this->mediaBox->toType(),
        'Count' => new Numeric(count($this->kids)),
        'Kids' => new Vector($kidsVector),
      ]
    );
  }
}