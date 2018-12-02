<?php

namespace PdfBuilder\Structure;


class Header extends PdfPart
{
  private $version;

  public function __construct(string $version)
  {
    $this->version = $version;
  }

  public function toString()
  {
    return '%PDF-' . $this->version . "\n";
  }
}