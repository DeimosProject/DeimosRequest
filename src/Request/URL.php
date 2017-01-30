<?php

namespace Deimos\Request;

use Deimos\Helper\Helper;

trait URL
{

    /**
     * @return bool
     */
    public function isHttps()
    {
        $https = $this->server('https');

        return $this->filterVariable($https, FILTER_VALIDATE_BOOLEAN, false);
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
     * Gets request URL
     *
     * @param bool $withParams Whether to preserve URL parameters
     *
     * @return string URL of this request
     */
    public function url($withParams = false)
    {
        $url = $this->isHttps() ? 'https://' : 'http://';
        $url .= $this->server('http_host');

        return $url . $this->urlPath($withParams);
    }

    /**
     * without host & schema
     *
     * @param bool $withParams
     *
     * @return mixed|string
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