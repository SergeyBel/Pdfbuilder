<?php

namespace PdfBuilder\Tests\Structure;


use PdfBuilder\Format\A4;
use PdfBuilder\PdfBuilder;
use PHPUnit\Framework\TestCase;

class NewPageTest extends TestCase
{
    public function testNewLine()
    {
        $answer = 'JVBERi0xLjcKMSAwIG9iago8PAovRm9udCA8PAo+PgovWE9iamVjdCA8PAo+Pgo+PgplbmRvYmoKMiAwIG9iago8PAovTGVuZ3RoIDAKPj4Kc3RyZWFtCmVuZHN0cmVhbQplbmRvYmoKMyAwIG9iago8PAovVHlwZSAvUGFnZQovUmVzb3VyY2VzIDEgMCBSCi9Db250ZW50cyAyIDAgUgovUGFyZW50IDcgMCBSCj4+CmVuZG9iago0IDAgb2JqCjw8Ci9Gb250IDw8Cj4+Ci9YT2JqZWN0IDw8Cj4+Cj4+CmVuZG9iago1IDAgb2JqCjw8Ci9MZW5ndGggMAo+PgpzdHJlYW0KZW5kc3RyZWFtCmVuZG9iago2IDAgb2JqCjw8Ci9UeXBlIC9QYWdlCi9SZXNvdXJjZXMgNCAwIFIKL0NvbnRlbnRzIDUgMCBSCi9QYXJlbnQgNyAwIFIKPj4KZW5kb2JqCjcgMCBvYmoKPDwKL1R5cGUgL1BhZ2VzCi9NZWRpYUJveCBbMCAwIDU5NS4yNzYgODQxLjg5XQovQ291bnQgMgovS2lkcyBbMyAwIFIgNiAwIFJdCj4+CmVuZG9iago4IDAgb2JqCjw8Ci9UeXBlIC9DYXRhbG9nCi9QYWdlcyA3IDAgUgo+PgplbmRvYmoKeHJlZgowIDkKMDAwMDAwMDAwMCA2NTUzNSBmIAowMDAwMDAwMDA5IDAwMDAwIG4gCjAwMDAwMDAwNTcgMDAwMDAgbiAKMDAwMDAwMDEwNSAwMDAwMCBuIAowMDAwMDAwMTg1IDAwMDAwIG4gCjAwMDAwMDAyMzMgMDAwMDAgbiAKMDAwMDAwMDI4MSAwMDAwMCBuIAowMDAwMDAwMzYxIDAwMDAwIG4gCjAwMDAwMDA0NTUgMDAwMDAgbiAKdHJhaWxlcgo8PAovU2l6ZSA5Ci9Sb290IDggMCBSCj4+CnN0YXJ0eHJlZgo1MDQKJSVFT0YK';
        $builder = new PdfBuilder(new A4());
        $pdf = $builder
            ->newPage()
            ->build();
        $this->assertEquals($answer, base64_encode($pdf->getAsSting()));
    }

}