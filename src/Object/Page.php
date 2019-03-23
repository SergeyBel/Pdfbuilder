<?php

namespace PdfBuilder\Object;

use PdfBuilder\Structure\BodyObject;
use PdfBuilder\Type\Dictionary;
use PdfBuilder\Type\Name;
use PdfBuilder\Type\Reference;

class Page implements Element
{
    private $resource;

    private $content;

    private $parent;

    public function __construct(BodyObject $resource, BodyObject $content)
    {
        $this->resource = $resource;
        $this->content = $content;
        $this->parent = null;
    }

    public function setParent(BodyObject $parent)
    {
        $this->parent = $parent;
    }

    public function toType()
    {
        return new Dictionary([
                                  'Type' => new Name('Page'),
                                  'Resources' => new Reference($this->resource),
                                  'Contents' => new Reference($this->content),
                                  'Parent' => new Reference($this->parent),
                              ]);
    }
}