<?php

namespace Deimos\Request;

use Deimos\Helper\Helper;

trait URL
{

    /**
     * @param bool $useRouter
     *
     * @return bool
     */
    public function isHttps($useRouter = true)
    {
        if ($useRouter && class_exists('\Deimos\Router\Router'))
        {
            // with cloudFlare
            return \Deimos\Router\scheme() === 'https';
        }

        $https = $this->server('https');
        $httpX = $this->server('http_x_forwarded_proto');

        return 
            $this->filterVariable($https, FILTER_VALIDATE_BOOLEAN, false) ||
            $this->filterVariable($httpX, FILTER_VALIDATE_BOOLEAN, false);
    }

    /**
     * @param string $string
     *
     * @return mixed
     */
    public function friendlyUrl($string)
    {
        /**
         * @var Helper $helper
         */
        $helper = $this->helper;

        $string = preg_replace('~[\s\t\n\r]+~', '-', $string);

        $string = $helper->str()->low($string);
        $string = $helper->str()->translit($string);

        return trim(preg_replace('~[^a-z0-9-]+~', '', $string), '-');
    }

    /**
     * @return string
     */
    public function scheme()
    {
        return $this->isHttps() ? 'https' : 'http';
    }

    /**
     * @return string
     */
    public function domain()
    {
        return $this->server('http_host');
    }

    /**
     * Gets request URL
     *
     * @param bool $withParams Whether to preserve URL parameters
     *
     * @return string URL of this request
     */
    public function url($withParams = false)
    {
        $url = $this->scheme() . '://';
        $url .= $this->domain();

        return $url . $this->urlPath($withParams);
    }

    /**
     * without host & schema
     *
     * @param bool $withParams
     *
     * @return string
     */
    public function urlPath($withParams = false)
    {
        $path = $this->server('request_uri');

        if (!$withParams)
        {
            $position = mb_strpos($path, '?');
            if ($position !== false)
            {
                $path = mb_substr($path, 0, $position);
            }
        }

        return $path;
    }

    /**
     * @param string|null $url
     *
     * @return string
     */
    public function queryString($url = null)
    {
        $query = '';

        if (!$url)
        {
            $url = $this->server('request_uri');
        }

        $position = mb_strpos($url, '?');

        if ($position !== false)
        {
            $query = mb_substr($url, $position + 1);
        }

        return $query;
    }

}
