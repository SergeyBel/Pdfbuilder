<?php

namespace PdfBuilder;


class PdfFile
{
    private $data;

    /**
     * PdfFile constructor.
     *
     * @param $data
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getAsSting()
    {
        return $this->data;
    }

    public function saveToFile(string $path)
    {
        file_put_contents($path, $this->data);
    }
}