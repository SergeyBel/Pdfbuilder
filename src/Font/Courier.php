<?php

namespace PdfBuilder\Font;


use PdfBuilder\Pdf\PdfFont;

class Courier extends PdfFont
{
    protected $name = 'Courier';

    public function __construct($size)
    {
        $this->widthTable = [];
        for ($i = 0; $i <= 255; $i++) {
            $this->widthTable[chr($i)] = 600;
        }
        parent::__construct($this->name, $size);
    }
}