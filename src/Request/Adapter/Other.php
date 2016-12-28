<?php

namespace Deimos\Request\Adapter;

/**
 * Class put
 *
 * @package Deimos\put\Adapter
 *
 * @method mixed putInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed putFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed putBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed putEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed putIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed putURL(string $path = null, mixed $default = null, bool $strip = true)
 *
 * @method mixed patchInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed patchFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed patchBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed patchEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed patchIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed patchURL(string $path = null, mixed $default = null, bool $strip = true)
 *
 * @method mixed deleteInt(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed deleteFloat(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed deleteBool(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed deleteEmail(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed deleteIP(string $path = null, mixed $default = null, bool $strip = true)
 * @method mixed deleteURL(string $path = null, mixed $default = null, bool $strip = true)
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
        return $this->deleteRequired($path, $strip);
    }

}