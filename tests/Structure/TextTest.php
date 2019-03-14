<?php

namespace PdfBuilder\Tests\Structure;


use PdfBuilder\Format\A4;
use PdfBuilder\PdfBuilder;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function testHelloWorld()
    {
        $answer = 'JVBERi0xLjcKMSAwIG9iago8PAovVHlwZSAvRm9udAovU3VidHlwZSAvVHlwZTEKL0Jhc2VGb250IC9Db3VyaWVyCj4+CmVuZG9iagoyIDAgb2JqCjw8Ci9Gb250IDw8Ci9GMSAxIDAgUgo+PgovWE9iamVjdCA8PAo+Pgo+PgplbmRvYmoKMyAwIG9iago8PAovTGVuZ3RoIDQ3Cj4+CnN0cmVhbQpCVAoxMCA4MTEuODkgVGQKL0YxIDEyIFRmCihIZWxsbyBXb3JsZCEpIFRqCkVUCmVuZHN0cmVhbQplbmRvYmoKNCAwIG9iago8PAovVHlwZSAvUGFnZQovUmVzb3VyY2VzIDIgMCBSCi9Db250ZW50cyAzIDAgUgovUGFyZW50IDUgMCBSCj4+CmVuZG9iago1IDAgb2JqCjw8Ci9UeXBlIC9QYWdlcwovTWVkaWFCb3ggWzAgMCA1OTUuMjc2IDg0MS44OV0KL0NvdW50IDEKL0tpZHMgWzQgMCBSXQo+PgplbmRvYmoKNiAwIG9iago8PAovVHlwZSAvQ2F0YWxvZwovUGFnZXMgNSAwIFIKPj4KZW5kb2JqCnhyZWYKMCA3CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAwOSAwMDAwMCBuIAowMDAwMDAwMDc3IDAwMDAwIG4gCjAwMDAwMDAxMzUgMDAwMDAgbiAKMDAwMDAwMDIzMSAwMDAwMCBuIAowMDAwMDAwMzExIDAwMDAwIG4gCjAwMDAwMDAzOTkgMDAwMDAgbiAKdHJhaWxlcgo8PAovU2l6ZSA3Ci9Sb290IDYgMCBSCj4+CnN0YXJ0eHJlZgo0NDgKJSVFT0YK';
        $builder = new PdfBuilder(new A4());
        $pdf = $builder
            ->write('Hello World!')
            ->build();
        $this->assertEquals($answer, base64_encode($pdf->getAsSting()));
    }

}