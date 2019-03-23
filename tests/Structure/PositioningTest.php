<?php

namespace PdfBuilder\Tests\Structure;


use PdfBuilder\Format\A4;
use PdfBuilder\PdfBuilder;
use PHPUnit\Framework\TestCase;

class PositioningTest extends TestCase
{
    public function testMove()
    {
        $answer = 'JVBERi0xLjcKMSAwIG9iago8PAovRm9udCA8PAo+PgovWE9iamVjdCA8PAo+Pgo+PgplbmRvYmoKMiAwIG9iago8PAovTGVuZ3RoIDAKPj4Kc3RyZWFtCmVuZHN0cmVhbQplbmRvYmoKMyAwIG9iago8PAovVHlwZSAvUGFnZQovUmVzb3VyY2VzIDEgMCBSCi9Db250ZW50cyAyIDAgUgovUGFyZW50IDQgMCBSCj4+CmVuZG9iago0IDAgb2JqCjw8Ci9UeXBlIC9QYWdlcwovTWVkaWFCb3ggWzAgMCA1OTUuMjc2IDg0MS44OV0KL0NvdW50IDEKL0tpZHMgWzMgMCBSXQo+PgplbmRvYmoKNSAwIG9iago8PAovVHlwZSAvQ2F0YWxvZwovUGFnZXMgNCAwIFIKPj4KZW5kb2JqCnhyZWYKMCA2CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAwOSAwMDAwMCBuIAowMDAwMDAwMDU3IDAwMDAwIG4gCjAwMDAwMDAxMDUgMDAwMDAgbiAKMDAwMDAwMDE4NSAwMDAwMCBuIAowMDAwMDAwMjczIDAwMDAwIG4gCnRyYWlsZXIKPDwKL1NpemUgNgovUm9vdCA1IDAgUgo+PgpzdGFydHhyZWYKMzIyCiUlRU9GCg==';
        $builder = new PdfBuilder(new A4());
        $pdf = $builder->move(20, 30)->build();
        $this->assertEquals($answer, base64_encode($pdf->getAsSting()));
    }

    public function testSetPosition()
    {
        $answer = 'JVBERi0xLjcKMSAwIG9iago8PAovRm9udCA8PAo+PgovWE9iamVjdCA8PAo+Pgo+PgplbmRvYmoKMiAwIG9iago8PAovTGVuZ3RoIDAKPj4Kc3RyZWFtCmVuZHN0cmVhbQplbmRvYmoKMyAwIG9iago8PAovVHlwZSAvUGFnZQovUmVzb3VyY2VzIDEgMCBSCi9Db250ZW50cyAyIDAgUgovUGFyZW50IDQgMCBSCj4+CmVuZG9iago0IDAgb2JqCjw8Ci9UeXBlIC9QYWdlcwovTWVkaWFCb3ggWzAgMCA1OTUuMjc2IDg0MS44OV0KL0NvdW50IDEKL0tpZHMgWzMgMCBSXQo+PgplbmRvYmoKNSAwIG9iago8PAovVHlwZSAvQ2F0YWxvZwovUGFnZXMgNCAwIFIKPj4KZW5kb2JqCnhyZWYKMCA2CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAwOSAwMDAwMCBuIAowMDAwMDAwMDU3IDAwMDAwIG4gCjAwMDAwMDAxMDUgMDAwMDAgbiAKMDAwMDAwMDE4NSAwMDAwMCBuIAowMDAwMDAwMjczIDAwMDAwIG4gCnRyYWlsZXIKPDwKL1NpemUgNgovUm9vdCA1IDAgUgo+PgpzdGFydHhyZWYKMzIyCiUlRU9GCg==';
        $builder = new PdfBuilder(new A4());
        $pdf = $builder->setPosition(20, 30)->build();
        $this->assertEquals($answer, base64_encode($pdf->getAsSting()));
    }

}