<?php

namespace Deimos\Request\Adapter;

/**
 * Class Router
 *
 * @package Deimos\Request\Adapter
 *
 * @method int attributeInt(string $path = null, mixed $default = 0)
 * @method float attributeFloat(string $path = null, mixed $default = 0.0)
 * @method bool attributeBool(string $path = null, mixed $default = false)
 * @method string attributeEmail(string $path = null, mixed $default = '')
 * @method string attributeIP(string $path = null, mixed $default = '')
 * @method string attributeURL(string $path = null, mixed $default = '')
 * @method mixed attributeUnsafe(string $path = null, mixed $default = '')
 * @method double attributeBetween(string $path = null, double $min, double $max)
 */
trait Router
{

    /**
     * @var \Deimos\Router\Router
     */
    private $router;

    /**
     * @var \Deimos\Router\Route
     */
    private $route;

    /**
     * @param \Deimos\Router\Router $router
     */
    public function setRouter(\Deimos\Router\Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param string $path
     * @param mixed  $default
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function attribute($path = null, $default = null)
    {
        return $this->arrGet($this->attributes(), $path, $default);
    }

    /**
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function attributes()
    {
        return $this->route()->attributes();
    }

    /**
     * @return \Deimos\Router\Route
     *
     * @throws \InvalidArgumentException
     */
    public function route()
    {
        if (!$this->route)
        {
            $path = $this->urlPath();
            $this->router->setMethod($this->method());

            $this->route = $this->router->getCurrentRoute($path);
        }

        return $this->route;
    }

    /**
     * @param string $path
     * @param bool   $strip
     *
     * @return mixed
     *
     * @throws \Deimos\Helper\Exceptions\ExceptionEmpty
     * @throws \InvalidArgumentException
     */
    public function attributeRequired($path = null, $strip = true)
    {
        return $this->arrRequired($this->attributes(), $path, $strip);
    }

}