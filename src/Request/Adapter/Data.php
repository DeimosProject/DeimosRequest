<?php

namespace Deimos\Request\Adapter;

/**
 * Class data
 *
 * @package Deimos\data\Adapter
 *
 * @method mixed dataInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed dataFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed dataBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed dataEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed dataIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed dataURL(string $path = null, mixed $default = null, bool $strip = true)
 *
 * @method mixed postInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed postFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed postBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed postEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed postIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed postURL(string $path = null, mixed $default = null, bool $strip = true)
 */
trait Data
{

    private $dataData;

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function post($path = null, $default = null, $strip = true)
    {
        return $this->data($path, $default, $strip);
    }

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function data($path = null, $default = null, $strip = true)
    {
        return $this->arrGetXss($this->dataData(), $path, $default, $strip);
    }

    /**
     * @return array
     */
    private function dataData()
    {
        if (!$this->dataData)
        {
            $this->dataData = $this->inputArray(INPUT_POST);
        }

        return $this->dataData;
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function postRequired($path, $strip = true)
    {
        return $this->dataRequired($path, $strip);
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function dataRequired($path, $strip = true)
    {
        return $this->arrRequired($this->dataData(), $path, $strip);
    }

}