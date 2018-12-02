<?php

namespace PdfBuilder\Type;


class Numeric implements Type
{
  private $value;

  public function __construct($value)
  {
    $this->value = $value;
  }

  public function toString()
  {
    return $this->value;
  }
}