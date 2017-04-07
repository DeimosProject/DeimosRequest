<?php

namespace Test;

use DeimosTest\TestSetUp;

class DataTest extends TestSetUp
{

    public function testPost()
    {
        $this->assertEquals(
            $_POST['postFoo'],
            $this->request->data('postFoo')
        );
    }

    public function testPostUnsafe()
    {
        $this->assertEquals(
            $_POST['postUnsafe'],
            $this->request->dataUnsafe('postUnsafe')
        );

        $this->assertNotEquals(
            $_POST['postUnsafe'],
            $this->request->data('postUnsafe')
        );
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testPostRequired()
    {
        $this->request->dataRequired('missing');
    }

    public function testPostArray()
    {
        $data = $this->request->dataRequired('postArray');

        $this->assertEquals('testA', $data['a']);
    }

    /**
     * @expectedException \BadFunctionCallException
     */
    public function testBadFunctionCallException()
    {
        $this->request->requiredMissingPost();
    }

}