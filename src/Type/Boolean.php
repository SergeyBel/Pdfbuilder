<?php

namespace PdfBuilder\Type;


class Boolean implements Type
{
    private $value;

    public function __construct(boolean $value)
    {
        $this->value = $value;
    }

    public function toString()
    {
        return $this->value === true ? 'true' : 'false';
    }
}