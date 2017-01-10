<?php

namespace Test;

use DeimosTest\TestSetUp;

class DataTest extends TestSetUp
{

    public function testPost()
    {
        $this->assertEquals(
            $_POST['postFoo'],
            $this->request->post('postFoo')
        );
    }

    public function testPostUnsafe()
    {
        $this->assertEquals(
            $_POST['postUnsafe'],
            $this->request->postUnsafe('postUnsafe')
        );

        $this->assertNotEquals(
            $_POST['postUnsafe'],
            $this->request->post('postUnsafe')
        );
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testPostRequired()
    {
        $this->request->postRequired('missing');
    }

    public function testPostArray()
    {
        $data = $this->request->postRequired('postArray');

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