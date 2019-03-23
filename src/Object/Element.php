<?php

namespace PdfBuilder\Object;

use PdfBuilder\Type\Type;

/**
 * Interface Element
 * Presents pdf element. It consists of some Type blocks
 * @package PdfBuilder\Object
 */
interface Element
{
  /**
   * @return Type
   */
  public function toType();
}