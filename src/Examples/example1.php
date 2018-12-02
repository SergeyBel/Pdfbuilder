<?php

namespace PdfBuilder;

use PdfBuilder\Font\CourierBold;
use PdfBuilder\Format\A4;


require_once __DIR__.'/../../vendor/autoload.php';


$builder = new PdfBuilder(new A4());

$pdf = $builder
  ->setFont(new CourierBold(12))
  ->write('Hello World!')
  ->build();
$pdf->saveToFile('example1.pdf');

