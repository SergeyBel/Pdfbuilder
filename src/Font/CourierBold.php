<?php

namespace PdfBuilder\Font;


class CourierBold extends Courier
{
    protected $name = 'Courier-Bold';

    public function __construct($size)
    {
        parent::__construct($size);
    }

}