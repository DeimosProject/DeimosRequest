<?php

namespace Deimos\Request\Adapter;

/**
 * Class query
 *
 * @package Deimos\query\Adapter
 *
 * @method mixed queryInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed queryFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed queryBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed queryEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed queryIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed queryURL(string $path = null, mixed $default = null, bool $strip = true)
 *
 * @method mixed getInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed getFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed getBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed getEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed getIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed getURL(string $path = null, mixed $default = null, bool $strip = true)
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
    public function get($path = null, $default = null, $strip = true)
    {
        return $this->query($path, $default, $strip);
    }

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
    public function getRequired($path = null, $strip = true)
    {
        return $this->queryRequired($path, $strip);
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