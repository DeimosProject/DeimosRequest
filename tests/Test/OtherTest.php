<?php

namespace Test;

use DeimosTest\TestSetUp;

class OtherTest extends TestSetUp
{

    public function testPatch()
    {
        $this->assertEquals(
            $_REQUEST['requestFooPath1'],
            $this->request->patch('requestFooPath1')
        );
        $this->assertNull($this->request->patch('getTestInt'));
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testPatchRequired()
    {
        $this->request->patchRequired('missing');
    }

    public function testDelete()
    {
        $this->assertEquals(
            $_REQUEST['requestFooPath1'],
            $this->request->delete('requestFooPath1')
        );
    }

    /**
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testDeleteRequired()
    {
        $this->request->deleteRequired('missing');
    }

}