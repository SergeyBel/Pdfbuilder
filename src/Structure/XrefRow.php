<?php

namespace PdfBuilder\Structure;


class XrefRow extends PdfPart
{
    const OFFSET_LENGTH = 10;

    private $offset;

    private $generation;

    private $keyword;

    public function __construct(string $offset, string $generation, string $keyword)
    {
        $this->offset = $this->formatOffset($offset);
        $this->generation = $generation;
        $this->keyword = $keyword;
    }

    public function toString()
    {
        return $this->offset.' '.$this->generation.' '.$this->keyword." \n";
    }

    private function formatOffset(string $offset)
    {
        return str_repeat('0', self::OFFSET_LENGTH - strlen($offset)).$offset;
    }
}