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

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testPostRequired()
    {
        $this->request->postRequired('missing');
    }

}