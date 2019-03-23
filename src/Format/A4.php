<?php

namespace PdfBuilder\Format;

use PdfBuilder\Pdf\PdfFormat;

class A4 extends PdfFormat
{
    public function __construct()
    {
        parent::__construct(595.276, 841.890);
    }
}