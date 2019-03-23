<?php

namespace PdfBuilder\Structure;


/**
 * Class PdfPart
 * Presents part of pdf file structure
 *
 * @package PdfBuilder\Structure
 */
abstract class PdfPart
{

    public function getSize()
    {
        return strlen($this->toString());
    }

    public abstract function toString();
}