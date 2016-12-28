<?php

namespace Deimos\Request\Adapter;

/**
 * Class Router
 *
 * @package Deimos\Request\Adapter
 *
 * @method attributeInt(string $path = null, mixed $default = null)
 * @method attributeFloat(string $path = null, mixed $default = null)
 * @method attributeBool(string $path = null, mixed $default = null)
 * @method attributeEmail(string $path = null, mixed $default = null)
 * @method attributeIP(string $path = null, mixed $default = null)
 * @method attributeURL(string $path = null, mixed $default = null)
 */
trait Router
{

    use Server;

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
        return $this->route()->attribute();
    }

    /**
     * @return \Deimos\Router\Route
     */
    private function route()
    {
        if (!$this->route)
        {
            $path = $this->server('request_uri', '/');

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