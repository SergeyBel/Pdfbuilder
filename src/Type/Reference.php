<?php

namespace PdfBuilder\Type;


use PdfBuilder\Structure\BodyObject;

class Reference implements Type
{
    private $id;

    private $generation;

    public function __construct(BodyObject $object)
    {
        $this->id = $object->getId();
        $this->generation = $object->getGeneration();
    }

    public function toString()
    {
        return $this->id.' '.$this->generation.' R';
    }
}