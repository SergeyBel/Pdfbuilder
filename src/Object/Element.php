<?php

namespace PdfBuilder\Object;


use PdfBuilder\Type\Type;

interface Element
{
  /**
   * @return Type
   */
  public function toType();
}