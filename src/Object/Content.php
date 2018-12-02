<?php

namespace PdfBuilder\Object;

use PdfBuilder\Line\Line;
use PdfBuilder\Type\Stream;

class Content implements Element
{
  private $lines;

  public function __construct(array $lines = [])
  {
    $this->lines = $lines;
  }

  public function addLine(Line $line)
  {
    $this->lines[] = $line;
  }

  public function toType()
  {
    $data = '';
    foreach ($this->lines as $line)
      $data .= $line->toString();
    return new Stream($data);
  }
}