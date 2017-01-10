<?php

namespace Test;

use DeimosTest\TestSetUp;

class RouterTest extends TestSetUp
{

    public function testRoute()
    {
        $attributes = $this->request->attributes();
        $this->assertEquals(
            'admin',
            $attributes['controller']
        );
        $this->assertEquals(
            'path',
            $attributes['action']
        );
        $this->assertEquals(
            '1',
            $attributes['value']
        );
    }

    /**
     * @urlPath /demo/deimos
     */
    public function testRoute1()
    {
        $attributes = $this->request->attributes();
        $this->assertEquals(
            'deimos',
            $attributes['controller']
        );
        $this->assertEquals(
            'request',
            $attributes['action']
        );
    }

    /**
     * @urlPath /demo/deimos-controller/123
     */
    public function testRoute2()
    {
        $attributes = $this->request->attributes();
        $this->assertEquals(
            'deimos-controller',
            $attributes['controller']
        );
        $this->assertEquals(
            '123',
            $attributes['action']
        );
    }

    /**
     * @urlPath /demo/deimos
     *
     */
    public function testAttribute()
    {
        $attribute = $this->request->attribute('controller');

        $this->assertEquals(
            'deimos',
            $attribute
        );
    }

    /**
     * @urlPath /demo/deimos
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testAttributeExpected()
    {
        $attribute = $this->request->attributeRequired('value');

        $this->assertEquals(
            'deimos',
            $attribute
        );
    }

}
