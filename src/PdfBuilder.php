<?php

namespace PdfBuilder;

use PdfBuilder\Font\Courier;
use PdfBuilder\Pdf\PdfFont;
use PdfBuilder\Pdf\PdfFormat;
use PdfBuilder\Pdf\PdfImage;
use PdfBuilder\Pdf\PdfIndent;
use PdfBuilder\Pdf\PdfNewline;
use PdfBuilder\Pdf\PdfPiece;
use PdfBuilder\Pdf\PdfPosition;
use PdfBuilder\Pdf\PdfText;
use PdfBuilder\Structure\PdfStructure;

class PdfBuilder
{
  private $pages;
  private $width;
  private $height;
  private $leftMargin;
  private $topMargin;

  private $currentPiece;

  public function __construct(PdfFormat $format, $leftMargin = 10, $topMargin = 30)
  {
    $this->width = $format->getWidth();
    $this->height = $format->getHeight();
    $this->pages = [];
    $this->currentPiece = new PdfPiece();
    $this->currentFont = new Courier(12);
    $this->leftMargin = $leftMargin;
    $this->topMargin = $topMargin;
  }

  public function write(string $text)
  {
    $this->currentPiece->addPart(new PdfText($text, $this->currentFont));
    return $this;
  }

  public function changePosition($dx, $dy)
  {
    $this->currentPiece->addPart(new PdfIndent($dx, $dy));
    return $this;
  }

  public function newPage()
  {
    $this->pages[] = clone $this->currentPiece;
    $this->currentPiece = new PdfPiece();
    return $this;
  }

  public function drawImage($file)
  {
    $this->currentPiece->addPart(new PdfImage($file));
    return $this;
  }

  public function setFont(PdfFont $font)
  {
    $this->currentFont = $font;
    return $this;
  }

  public function setPosition($x = null, $y = null)
  {
    $this->currentPiece->addPart(new PdfPosition($x, $y));
    return $this;
  }

  public function newline()
  {
    $this->currentPiece->addPart(new PdfNewline());
    return $this;
  }

  public function build()
  {
    $this->pages[] = $this->currentPiece;
    return (new PdfStructure(
      $this->width,
      $this->height,
      $this->leftMargin,
      $this->topMargin
    )
    )
      ->build($this->pages);
  }
}