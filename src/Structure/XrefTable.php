<?php

namespace PdfBuilder\Structure;


class XrefTable extends PdfPart
{
    private $table;

    public function __construct()
    {
        $this->table = [];
    }

    public function generateTable(Body $body, $startOffset)
    {
        $offset = $startOffset;
        $this->table[] = new XrefRow('0000000000', '65535', 'f');
        foreach ($body->getObjects() as $object) {
            $this->table[] = new XrefRow($offset, '00000', 'n');
            $offset += $object->getSize() + 1;
        }
    }

    public function getCount()
    {
        return count($this->table);
    }

    public function toString()
    {
        $text = "xref\n";
        $text .= '0 '.count($this->table)."\n";
        foreach ($this->table as $row) {
            $text .= $row->toString();
        }
        return $text;
    }
}