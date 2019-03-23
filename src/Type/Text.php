<?php

namespace PdfBuilder\Type;


class Text implements Type
{
    private $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    public function toString()
    {
        return '('.$this->str.')';
    }
}