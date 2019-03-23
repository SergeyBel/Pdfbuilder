<?php

namespace PdfBuilder\Format;

use PdfBuilder\Pdf\PdfFormat;

class A3 extends PdfFormat
{
    public function __construct()
    {
        parent::__construct(841.89, 1190.55);
    }
}