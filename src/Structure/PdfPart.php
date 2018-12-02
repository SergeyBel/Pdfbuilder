<?php

namespace PdfBuilder\Structure;


abstract class PdfPart
{

  public function getSize()
  {
    return strlen($this->toString());
  }

  public abstract function toString();
}