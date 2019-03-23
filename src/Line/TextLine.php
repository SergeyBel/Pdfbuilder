<?php

namespace PdfBuilder\Line;

use PdfBuilder\Type\Name;

class TextLine implements Line
{
    private $text;

    private $x;

    private $y;

    private $fontId;

    private $fontSize;

    public function __construct(string $text, float $x, float $y, string $fontId, int $fontSize)
    {
        $this->text = $text;
        $this->x = $x;
        $this->y = $y;
        $this->fontId = $fontId;
        $this->fontSize = $fontSize;
    }

    public function toString()
    {
        $data = "BT\n";
        $data .= $this->x." ".$this->y." Td\n";
        $data .= (new Name($this->fontId))->toString()." ".$this->fontSize." Tf\n";
        $data .= "(".$this->text.") Tj\n";
        $data .= "ET\n";

        return $data;
    }
}