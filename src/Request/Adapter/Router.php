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
     */
    public function attribute($path = null, $default = null)
    {
        $path = $this->normalizeLow($path);

        return $this->arrGet($this->attributes(), $path, $default);
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return $this->route()->attributes();
    }

    /**
     * @return \Deimos\Router\Route
     */
    private function route()
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
     */
    public function attributeRequired($path = null, $strip = true)
    {
        return $this->arrRequired($this->attributes(), $path, $strip);
    }

}