<?php

namespace Deimos\Request\Adapter;

/**
 * Class query
 *
 * @package Deimos\query\Adapter
 *
 * @method int queryInt(string $path = null, mixed $default = 0, bool $strip = true)
 * @method float queryFloat(string $path = null, mixed $default = 0.0, bool $strip = true)
 * @method bool queryBool(string $path = null, mixed $default = false, bool $strip = true)
 * @method string queryEmail(string $path = null, mixed $default = '', bool $strip = true)
 * @method string queryIP(string $path = null, mixed $default = '', bool $strip = true)
 * @method string queryURL(string $path = null, mixed $default = '', bool $strip = true)
 * @method mixed queryUnsafe(string $path = null, mixed $default = '')
 * @method double queryBetween(string $path = null, double $min, double $max)
 */
trait Query
{

    /**
     * @var array
     */
    private $queryData;

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function query($path = null, $default = null, $strip = true)
    {
        return $this->arrGetXss($this->queryData(), $path, $default, $strip);
    }

    /**
     * @return array
     */
    private function queryData()
    {
        if (!$this->queryData)
        {
            $this->queryData = $this->inputArray(INPUT_GET);
        }

        return $this->queryData;
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     *
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function queryRequired($path = null, $strip = true)
    {
        return $this->arrRequired($this->queryData(), $path, $strip);
    }

}