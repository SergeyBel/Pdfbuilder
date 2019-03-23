<?php

namespace PdfBuilder\Structure;

use PdfBuilder\Object\Catalog;
use PdfBuilder\Object\Pages;
use PdfBuilder\Object\Element as Element;
use PdfBuilder\Object\Rectangle;

class Body extends PdfPart
{
  private $objects;
  private $catalog;
  private $width;
  private $height;

  public function __construct(float $width, float $height)
  {
    $this->width = $width;
    $this->height = $height;
    $this->objects = [];
    $this->catalog = null;
  }

  public function build()
  {
    $pages = $this->createPages();
    $catalog = new Catalog($pages);
    $this->catalog = $this->addElement($catalog);
  }

  public function addElement(Element $element)
  {
    $obj = new BodyObject($this->getNextIndex(), $element);
    $this->objects[] = $obj;
    return $obj;
  }

  public function toString()
  {
    $text = '';
    foreach ($this->objects as $object)
      $text .= $object->toString()."\n";
    return $text;
  }

  public function getCatalog()
  {
    return $this->catalog;
  }

  /**
   * @return BodyObject[]
   */
  public function getObjects()
  {
    return $this->objects;
  }

  private function createPages()
  {
    $pages = new Pages([], new Rectangle(0, 0, $this->width, $this->height));
    $pagesObj = $this->addElement($pages);
    foreach ($this->objects as $object)
    {
      if ($object->isPage())
      {
        /** @var Pages $pagesElement */
        $pagesElement = $pagesObj->getElement();
        $pagesElement->addKid($object);
        $object->getElement()->setParent($pagesObj);
      }
    }
    return $pagesObj;
  }

  private function getNextIndex()
  {
    return count($this->objects) + 1;
  }
}