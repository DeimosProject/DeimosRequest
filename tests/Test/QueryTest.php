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


        $this->assertEquals('123', $this->request->queryBetween('getTestInt', 1, 125));
        $this->assertEquals('125', $this->request->queryBetween('getTestInt', 125, 250));
        $this->assertEquals('120', $this->request->queryBetween('getTestInt', -5, 120));

        // first / last
        $this->assertEquals('a', $this->request->queryBetween('first', 'a', 'z'));
        $this->assertEquals('b', $this->request->queryBetween('first', 'b', 'z'));
        
        $this->assertEquals('y', $this->request->queryBetween('last', 'a', 'y'));
        $this->assertEquals('z', $this->request->queryBetween('last', 'b', 'z'));
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testGerRequiredError()
    {
        $this->request->queryRequired('testMissed');
    }

}