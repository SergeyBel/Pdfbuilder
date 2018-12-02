<?php

namespace PdfBuilder\Type;


class Dictionary implements Type
{
  /** @var Type[] $data */
  private $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function toString()
  {
    $text = "<<\n";
    foreach ($this->data as $key => $value) {
      $text .= (new Name($key))->toString() . ' ' . $value->toString() . "\n";
    }
    $text .= ">>";
    return $text;
  }

  public function getByKey($key)
  {
    return $this->data[$key];
  }

  public function add($key, $value)
  {
    $this->data[$key] = $value;
  }

  public function getData()
  {
    return $this->data;
  }

  public function merge(Dictionary $dictionary)
  {
    foreach ($dictionary->getData() as $key => $value)
      $this->add($key, $value);
  }
}