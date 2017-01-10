<?php

namespace Test;

use DeimosTest\TestSetUp;

class RequestTest extends TestSetUp
{

    public function testIs()
    {
        $this->assertFalse($this->request->isHttps());
        $this->assertFalse($this->request->isAjax());
        $this->assertFalse($this->request->isDelete());
        $this->assertFalse($this->request->isHead());
        $this->assertFalse($this->request->isPut());
        $this->assertFalse($this->request->isPatch());
        $this->assertFalse($this->request->isPost());
        $this->assertTrue($this->request->isGet());
    }

    /**
     * @ajax true
     */
    public function testIsAjax()
    {
        $this->assertTrue($this->request->isAjax());
    }

    public function testUrl()
    {
        $this->assertEquals(
            'http://unit-test/admin/path/1',
            $this->request->url()
        );

        $this->assertEquals(
            'test=1',
            $this->request->queryString()
        );
    }

    public function testServer()
    {
        $this->assertTrue(is_array($this->request->server()));
    }

    /**
     * @runInSeparateProcess
     */
    public function testJson()
    {
        $testArray = ['Бесплатный', 'сервис', 'Google', '3'];
        $this->assertEquals(
            json_encode($testArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            $this->request->json($testArray, [JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE])
        );
        $this->assertEquals(
            json_encode($testArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            $this->request->json($testArray)
        );
        $this->assertEquals(
            json_encode($testArray, JSON_ERROR_NONE),
            $this->request->json($testArray, JSON_ERROR_NONE)
        );
    }

    public function testRequest()
    {
        $request = $this->request->request('requestFooPath1');

        $this->assertEquals($request, $_REQUEST['requestFooPath1']);
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testRequestRequired()
    {
        $this->request->requestRequired('requestFooPath');
    }

}