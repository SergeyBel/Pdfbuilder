<?php

namespace PdfBuilder\Pdf;

class PdfImage
{
    protected $width;

    protected $height;

    protected $colorType;

    protected $bits;

    protected $channels;

    protected $data;

    protected $name;

    public function __construct(string $path)
    {
        $info = getimagesize($path);
        $this->width = $info[0];
        $this->height = $info[1];
        $this->colorType = $info['channels'] == 3 ? 'RGB' : 'CMYK';
        $this->bits = $info['bits'];
        $this->name = $path;
        $this->data = file_get_contents($path);
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getColorType(): string
    {
        return $this->colorType;
    }

    /**
     * @return mixed
     */
    public function getBits()
    {
        return $this->bits;
    }

    /**
     * @return mixed
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @return false|string
     */
    public function getData()
    {
        return $this->data;
    }

    public function getName()
    {
        return $this->name;
    }
}