<?php

namespace Test;

use DeimosTest\TestSetUp;

class QueryTest extends TestSetUp
{

    public function testGet()
    {
        $this->assertNull($this->request->get('test'));
    }

    public function testQueryInt()
    {
        $this->assertEquals('123', $this->request->getInt('getTestInt'));
        $this->assertEquals(0, $this->request->getInt('getTestIntDefault'));
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testGerRequiredError()
    {
        $this->request->getRequired('testMissed');
    }

}