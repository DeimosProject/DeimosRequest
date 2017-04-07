<?php

namespace Test;

use DeimosTest\TestSetUp;

class QueryTest extends TestSetUp
{

    public function testGet()
    {
        $this->assertNull($this->request->query('test'));
    }

    public function testQueryInt()
    {
        $this->assertEquals('123', $this->request->queryInt('getTestInt'));
        $this->assertEquals(0, $this->request->queryInt('getTestIntDefault'));
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testGerRequiredError()
    {
        $this->request->queryRequired('testMissed');
    }

}