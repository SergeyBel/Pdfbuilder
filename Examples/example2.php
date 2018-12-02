<?php

namespace PdfBuilder;

use PdfBuilder\Format\A4;

require_once __DIR__.'/../vendor/autoload.php';


$builder = new PdfBuilder(new A4());

$pdf = $builder
  ->drawImage('logo.jpg')
  ->build();
$pdf->saveToFile('example2.pdf');