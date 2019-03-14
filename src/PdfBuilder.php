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

  public function __construct(PdfFormat $format = null, int $leftMargin = 10, int $topMargin = 30)
  {
    if ($format) {
      $this->width = $format->getWidth();
      $this->height = $format->getHeight();
    }
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

  public function move(int $dx, int $dy)
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

  public function drawImage(string $file)
  {
    $this->currentPiece->addPart(new PdfImage($file));
    return $this;
  }

  public function setFont(PdfFont $font)
  {
    $this->currentFont = $font;
    return $this;
  }

  public function setPosition(int $x = null, int $y = null)
  {
    $this->currentPiece->addPart(new PdfPosition($x, $y));
    return $this;
  }

  public function newLine()
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

  /**
   * @return mixed
   */
  public function getWidth()
  {
    return $this->width;
  }

  /**
   * @param mixed $width
   * @return PdfBuilder
   */
  public function setWidth(int $width)
  {
    $this->width = $width;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getHeight()
  {
    return $this->height;
  }

  /**
   * @param mixed $height
   * @return PdfBuilder
   */
  public function setHeight(int $height)
  {
    $this->height = $height;
    return $this;
  }

  /**
   * @return Courier
   */
  public function getCurrentFont(): Courier
  {
    return $this->currentFont;
  }

  /**
   * @param Courier $currentFont
   * @return PdfBuilder
   */
  public function setCurrentFont($currentFont)
  {
    $this->currentFont = $currentFont;
    return $this;
  }

  /**
   * @return int
   */
  public function getLeftMargin(): int
  {
    return $this->leftMargin;
  }

  /**
   * @param int $leftMargin
   * @return PdfBuilder
   */
  public function setLeftMargin($leftMargin)
  {
    $this->leftMargin = $leftMargin;
    return $this;
  }

  /**
   * @return int
   */
  public function getTopMargin(): int
  {
    return $this->topMargin;
  }

  /**
   * @param int $topMargin
   * @return PdfBuilder
   */
  public function setTopMargin(int $topMargin)
  {
    $this->topMargin = $topMargin;
    return $this;
  }

}