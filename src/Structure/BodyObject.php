<?php

namespace PdfBuilder\Structure;

use PdfBuilder\Object\Element as Element;
use PdfBuilder\Object\Page;

class BodyObject
{
    protected $id;

    protected $generation;

    protected $element;

    public function __construct(string $id, Element $element, int $generation = 0)
    {
        $this->id = $id;
        $this->element = $element;
        $this->generation = $generation;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGeneration()
    {
        return $this->generation;
    }

    public function toString()
    {
        $text = $this->id.' '.$this->generation." obj\n";
        $text .= $this->element->toType()->toString()."\n";
        $text .= "endobj";
        return $text;
    }

    public function getSize()
    {
        return strlen($this->toString());
    }

    public function getElement()
    {
        return $this->element;
    }

    public function isPage()
    {
        return $this->element instanceof Page;
    }
}