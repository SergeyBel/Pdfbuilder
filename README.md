# Pdfbuilder
Simple builder for PDF files  
Requires PHP >= 7.0.

## Basic Usage

```php
<?php

use PdfBuilder\Format\A4;

$builder = new PdfBuilder(new A4());

$pdf = $builder
  ->write('Hello World!')
  ->build();
```
This example create pdf file with one string 'Hello World!'

## Text:

### write($text)
Add text

```php
$pdf = $builder
  ->write('My name')
  ->build();
```

### setFont(PdfFont $font)
Set new font for text writing. Available fonts are in the 'src/Fonts' directory
```php
$pdf = $builder
  ->setFont(new Courier(12))
  ->write('Hello')
  ->setFont(new CourierBold(20))
  ->write('World')
  ->build();
```
### newLine()
Add newline manually. If the text takes more than a line, then a new one is added automatically

```php
$pdf = $builder
  ->write('Hello')
  ->newLine()
  ->write('World')
  ->build();
```

### newPage()
Add new page manually. If the text takes more than a page, then a new one is created automatically

```php
$pdf = $builder
  ->write('Hello')
  ->newPage()
  ->write('World')
  ->build();
```

## Graphics:

### drawImage($file)
Add new image from file. Supported formats: jpg

```php
$pdf = $builder
  ->drawImage('cat.jpg')
  ->build();
```

## Positioning
### move($dx, $dy)
Change pen position right `dx` and down `dy`

```php
$pdf = $builder
  ->write('Hello')
  ->move(40, 50)
  ->write('World')
  ->build();
```
### setPosition($x, $y)
Set pen position

```php
$pdf = $builder
  ->write('Hello')
  ->setPosition(100, 200)
  ->write('World')
  ->build();
```
