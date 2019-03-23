<?php

namespace PdfBuilder\Structure;

use PdfBuilder\Object\Content;
use PdfBuilder\Object\Font;
use PdfBuilder\Object\Image;
use PdfBuilder\Object\Page;
use PdfBuilder\Object\Resource;
use PdfBuilder\Pdf\PdfFont;
use PdfBuilder\Pdf\PdfImage;
use PdfBuilder\Pdf\PdfIndent;
use PdfBuilder\Pdf\PdfNewline;
use PdfBuilder\Pdf\PdfPiece;
use PdfBuilder\Pdf\PdfPosition;
use PdfBuilder\Pdf\PdfText;
use PdfBuilder\PdfFile;
use PdfBuilder\Line\ImageLine;
use PdfBuilder\Line\TextLine;
use PdfBuilder\Type\Numeric;
use PdfBuilder\Type\Reference;

class PdfStructure
{
  const VERSION = '1.7';

  private $header;
  private $body;
  /** @var XrefTable */
  private $xrefTable;
  /** @var Trailer */
  private $trailer;

  private $leftMargin;
  private $topMargin;
  private $width;
  private $height;


  private $x;
  private $y;
  private $lastLineHeight;
  private $fonts;
  private $images;
  private $currentPage;
  private $resource;


  public function __construct(float $width, float $height, float $leftMargin, float $topMargin)
  {
    $this->width = $width;
    $this->height = $height;
    $this->topMargin = $topMargin;
    $this->leftMargin = $leftMargin;
    $this->lastLineHeight = $this->topMargin;
    $this->fonts = [];
    $this->images = [];
    $this->currentPage = new Content();
    $this->header = new Header(self::VERSION);
    $this->body = new Body($this->width, $this->height);
  }

  public function build(array $pieces)
  {
    $this->getResources($pieces);
    $this->resource = $this->createResource();

    foreach ($pieces as $piece) {
        $this->processPiece($piece);
    }
    return new PdfFile($this->createFileStructure());
  }

  private function processPiece(PdfPiece $piece)
  {
      $this->x = $this->getXStartPosition();
      $this->y = $this->getYStartPosition();
      foreach ($piece->getParts() as $piecePart) {
          $this->processPiecePart($piecePart);
      }
      $this->addPage($this->resource, $this->currentPage);
      $this->currentPage = new Content();
  }

  private function processPiecePart($piecePart)
  {
      if ($piecePart instanceof PdfText) {
          $this->processTextPart($piecePart);
      } else if ($piecePart instanceof PdfIndent) {
          $this->processIdentPart($piecePart);
      } else if ($piecePart instanceof PdfImage) {
          $this->processImagePart($piecePart);
      } else if ($piecePart instanceof PdfPosition) {
          $this->processPositionPart($piecePart);
      } else if ($piecePart instanceof PdfNewline) {
          $this->processNewlinePart();
      }
  }

  private function processTextPart(PdfText $piecePart)
  {
      $contents = $this->writeText($piecePart->getText(), $piecePart->getFont());
      foreach ($contents as $content) {
          $this->addPage($this->resource, $content);
      }
  }

  private function processIdentPart(PdfIndent $piecePart)
  {
      $this->x += min($this->width, $piecePart->getX());
      $this->y -= min($this->height, $piecePart->getY());
  }

    private function processImagePart(PdfImage $image)
    {
        $this->currentPage->addLine(new ImageLine(
                                        $this->images[$image->getName()]['id'],
                                        $image->getWidth(),
                                        $image->getHeight(),
                                        $this->x,
                                        $this->y + $this->lastLineHeight
                                    )
        );
        $this->x += $image->getWidth();
    }

    private function processPositionPart(PdfPosition $piecePart)
    {
        if ($piecePart->getX())
            $this->x = $piecePart->getX();
        if ($piecePart->getY())
            $this->y = $piecePart->getY();
    }

    private function processNewlinePart()
    {
        $this->newline();
        if ($this->y <= 0)
        {
            $this->newpage();
            $this->addPage($this->resource, clone $this->currentPage);
            $this->currentPage = new Content();
        }
    }

  private function createFileStructure()
  {
    $this->body->build();
    $this->createXrefTable();
    $this->createTrailer();
    $text = $this->header->toString();
    $text .= $this->body->toString();
    $text .= $this->xrefTable->toString();
    $text .= $this->trailer->toString();
    return $text;
  }

  private function writeText(string $text, PdfFont $font)
  {
    $this->lastLineHeight = $font->getSize();
    $contents = [];
    $n = strlen($text);
    $start = 0;
    for ($i = 0; $i < $n; $i++) {
      $length = $font->textWidth(substr($text, $start, $i - $start));
      if ($length > $this->width) {
        $this->currentPage->addLine(new TextLine(
            substr($text, $start, $i - $start - 1),
            $this->x,
            $this->y,
            $this->fonts[$font->getName()]['id'],
            $font->getSize()
          )
        );
        $this->newline();
        $start = $i;
        if ($this->y <= 0)  //new page
        {
          $this->newpage();
          $contents[] = clone $this->currentPage;
          $this->currentPage = new Content();
        }

      }
    }
    $this->currentPage->addLine(new TextLine(
        substr($text, $start, $n - $start),
        $this->x,
        $this->y,
        $this->fonts[$font->getName()]['id'],
        $font->getSize()
      )
    );

    $this->x += $font->textWidth(substr($text, $start, $n - $start));
    return $contents;
  }
  

  private function getResources(array $pieces)
  {
    $fontCount = 1;
    $imageCount = 1;
    foreach ($pieces as $piece) {
      foreach ($piece->getParts() as $pagePiece) {
        if ($pagePiece instanceof PdfText) {
          $font = $pagePiece->getFont();
          $fontId = 'F' . $fontCount;
          $this->fonts[$font->getName()] = ['font' => $font, 'id' => $fontId];
          $fontCount++;
        }
        if ($pagePiece instanceof PdfImage) {
          $imageId = 'I' . $imageCount;
          $this->images[$pagePiece->getName()] = ['id' => $imageId, 'image' => $pagePiece];
          $imageCount++;
        }
      }
    }
  }

  private function createResource()
  {
    $resource = new Resource();
    $this->addFontsToResource($resource);
    $this->addImagesToResource($resource);
    return $resource;
  }

  private function addFontsToResource(Resource $resource)
  {
    foreach ($this->fonts as $fontName => $fontData) {
      /** @var PdfFont $font */
      $font = $fontData['font'];
      $fontElement = new Font($font->getName());
      $fontObj = $this->body->addElement($fontElement);
      $resource->addFont($fontData['id'], $fontObj);
    }
  }

  private function addImagesToResource(Resource $resource)
  {
    foreach ($this->images as $imageName => $imageData) {
      /** @var PdfImage $image */
      $image = $imageData['image'];
      $imageElement = new Image(
        $image->getWidth(),
        $image->getHeight(),
        $image->getColorType() == 'RGB' ? 'DeviceRGB' : 'DeviceCMYK',
        $image->getBits(),
        'DCTDecode',
        $image->getData()
      );
      $imageObj = $this->body->addElement($imageElement);
      $resource->addImage($imageData['id'], $imageObj);
    }
  }

  private function addPage(Resource $resource, Content $pageContent)
  {
    $resObj = $this->body->addElement($resource);
    $contentObj = $this->body->addElement($pageContent);
    $pageElement = new Page($resObj, $contentObj);
    $this->body->addElement($pageElement);
  }

  private function createXrefTable()
  {
    $this->xrefTable = new XrefTable();
    $this->xrefTable->generateTable($this->body, $this->header->getSize());
  }

  private function createTrailer()
  {
    $root = new Reference($this->body->getCatalog());
    $this->trailer = new Trailer(
      new Numeric($this->xrefTable->getCount()),
      $root,
      $this->header->getSize() + $this->body->getSize()
    );
  }

  private function newline()
  {
    $this->y -= $this->lastLineHeight;
    $this->x = $this->getXStartPosition();
  }

  private function newpage()
  {
    $this->y = $this->height - $this->lastLineHeight;
    $this->x = $this->getXStartPosition();
  }

  private function getXStartPosition()
  {
    return $this->leftMargin;
  }

  private function getYStartPosition()
  {
    return $this->height - $this->topMargin;
  }
}