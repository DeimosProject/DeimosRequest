<?php

namespace Deimos\Request\Adapter;

/**
 * Class data
 *
 * @package Deimos\data\Adapter
 *
 * @method int dataInt(string $path = null, mixed $default = 0, bool $strip = true)
 * @method float dataFloat(string $path = null, mixed $default = 0.0, bool $strip = true)
 * @method bool dataBool(string $path = null, mixed $default = false, bool $strip = true)
 * @method string dataEmail(string $path = null, mixed $default = '', bool $strip = true)
 * @method string dataIP(string $path = null, mixed $default = '', bool $strip = true)
 * @method string dataURL(string $path = null, mixed $default = '', bool $strip = true)
 * @method mixed dataUnsafe(string $path = null, mixed $default = '')
 * @method double dataBetween(string $path = null, double $min, double $max)
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
    public function dataRequired($path, $strip = true)
    {
        return $this->arrRequired($this->dataData(), $path, $strip);
    }

}