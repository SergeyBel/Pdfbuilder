<?php

namespace PdfBuilder\Pdf;


class PdfText
{
  private $text;
  private $font;

  public function __construct(string $text, PdfFont $font)
  {
    $this->text = $text;
    $this->font = $font;
  }

  /**
   * @return string
   */
  public function getText(): string
  {
    return $this->text;
  }

  /**
   * @return PdfFont
   */
  public function getFont(): PdfFont
  {
    return $this->font;
  }
}