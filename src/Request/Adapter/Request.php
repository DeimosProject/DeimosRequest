<?php

namespace Deimos\Request\Adapter;

/**
 * Class Request
 *
 * @package Deimos\Request\Adapter
 *
 * @method int requestInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method float requestFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method bool requestBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method string requestEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method string requestIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method string requestURL(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed requestUnsafe(string $path = null, mixed $default = null)
 */
trait Request
{

    /**
     * @var array
     */
    private $requestData;

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function request($path = null, $default = null, $strip = true)
    {
        return $this->arrGetXss($this->requestData(), $path, $default, $strip);
    }

    /**
     * @return array
     */
    private function requestData()
    {
        if (!$this->requestData)
        {
            $this->requestData = $_REQUEST;
        }

        return $this->requestData;
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     *
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function requestRequired($path = null, $strip = true)
    {
        return $this->arrRequired($this->requestData(), $path, $strip);
    }

}