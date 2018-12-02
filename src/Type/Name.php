<?php

namespace PdfBuilder\Type;


class Name implements Type
{
  private $name;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function toString()
  {
    return '/' . $this->name;
  }
}