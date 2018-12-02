<?php

namespace PdfBuilder\Type;


class Stream implements Type
{
  private $dictionary;
  private $streamData;

  public function __construct(string $streamData, Dictionary $options = null)
  {
    $this->dictionary = new Dictionary(
      [
        'Length' => new Numeric(strlen($streamData))
      ]
    );
    if ($options)
      $this->dictionary->merge($options);
    $this->streamData = $streamData;
  }

  public function toString()
  {
    $text = $this->dictionary->toString()."\n";
    $text .= "stream\n";
    $text .= $this->streamData;
    $text .= "endstream";
    return $text;
  }
}