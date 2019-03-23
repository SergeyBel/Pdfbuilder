<?php

namespace PdfBuilder\Type;


class Vector implements Type
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function add(Type $type)
    {
        $this->data[] = $type;
    }

    public function getCount(): int
    {
        return count($this->data);
    }

    public function toString()
    {
        $typesStrings = [];
        foreach ($this->data as $value) {
            $typesStrings[] = $value->toString();
        }

        return '['.implode(' ', $typesStrings).']';
    }
}