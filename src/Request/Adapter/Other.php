<?php

namespace Deimos\Request\Adapter;

/**
 * Class put
 *
 * @package Deimos\put\Adapter
 *
 * @method int putInt(string $path = null, mixed $default = 0, bool $strip = true)
 * @method float putFloat(string $path = null, mixed $default = 0.0, bool $strip = true)
 * @method bool putBool(string $path = null, mixed $default = false, bool $strip = true)
 * @method string putEmail(string $path = null, mixed $default = '', bool $strip = true)
 * @method string putIP(string $path = null, mixed $default = '', bool $strip = true)
 * @method string putURL(string $path = null, mixed $default = '', bool $strip = true)
 * @method mixed putUnsafe(string $path = null, mixed $default = '')
 *
 * @method int patchInt(string $path = null, mixed $default = 0, bool $strip = true)
 * @method float patchFloat(string $path = null, mixed $default = 0.0, bool $strip = true)
 * @method bool patchBool(string $path = null, mixed $default = false, bool $strip = true)
 * @method string patchEmail(string $path = null, mixed $default = '', bool $strip = true)
 * @method string patchIP(string $path = null, mixed $default = '', bool $strip = true)
 * @method string patchURL(string $path = null, mixed $default = '', bool $strip = true)
 * @method mixed pathUnsafe(string $path = null, mixed $default = '')
 *
 * @method int deleteInt(string $path = null, mixed $default = 0, bool $strip = true)
 * @method float deleteFloat(string $path = null, mixed $default = 0.0, bool $strip = true)
 * @method bool deleteBool(string $path = null, mixed $default = false, bool $strip = true)
 * @method string deleteEmail(string $path = null, mixed $default = '', bool $strip = true)
 * @method string deleteIP(string $path = null, mixed $default = '', bool $strip = true)
 * @method string deleteURL(string $path = null, mixed $default = '', bool $strip = true)
 * @method mixed deleteUnsafe(string $path = null, mixed $default = '')
 */
trait Other
{

    /**
     * @var array
     */
    private $otherData;

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function patch($path = null, $default = null, $strip = true)
    {
        return $this->put($path, $default, $strip);
    }

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function put($path = null, $default = null, $strip = true)
    {
        return $this->arrGetXss($this->otherData(), $path, $default, $strip);
    }

    /**
     * @return array
     */
    private function otherData()
    {
        if (!$this->otherData)
        {
            $this->otherData = $this->getInput();
        }

        return $this->otherData;
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function patchRequired($path, $strip = true)
    {
        return $this->putRequired($path, $strip);
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function putRequired($path, $strip = true)
    {
        return $this->arrRequired($this->otherData(), $path, $strip);
    }

    /**
     * @param string $path
     * @param mixed  $default
     * @param bool   $strip
     *
     * @return mixed
     */
    public function delete($path = null, $default = null, $strip = true)
    {
        return $this->put($path, $default, $strip);
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function deleteRequired($path, $strip = true)
    {
        return $this->arrRequired($this->otherData(), $path, $strip);
    }

}