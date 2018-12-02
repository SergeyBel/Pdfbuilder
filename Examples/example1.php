<?php

namespace PdfBuilder;

use PdfBuilder\Font\Courier;
use PdfBuilder\Format\A4;

require_once __DIR__.'/../vendor/autoload.php';


$builder = new PdfBuilder(new A4());

$pdf = $builder
  ->setFont(new Courier(12))
  ->write('Hello World!')
  ->build();
$pdf->saveToFile('example1.pdf');

