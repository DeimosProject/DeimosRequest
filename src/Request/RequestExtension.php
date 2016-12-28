<?php

namespace Deimos\Request;

trait RequestExtension
{

    use Adapter\Request;
    use Adapter\Server;
    use Adapter\Router;
    use Adapter\Query;
    use Adapter\Other;
    use Adapter\Data;

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
        $url .= $this->server('http_host') . $this->server('request_uri');

        if (!$withParams)
        {
            $position = mb_strpos($url, '?');
            if ($position !== false)
            {
                $url = mb_substr($url, 0, $position);
            }
        }

        return $url;
    }

    /**
     * @return bool
     */
    public function isHttps()
    {
        $https = $this->server('https');

        return $this->filterVariable($https, FILTER_VALIDATE_BOOLEAN, false);
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

    /**
     * @param array     $data
     * @param int|array $options
     */
    public function sendJson(array $data = array(), $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    {

        if (!headers_sent())
        {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Tue, 19 May 1981 18:00:00 GMT');
            header('Content-type: application/json; charset=utf-8');
        }

        if (is_array($options))
        {
            foreach ($options as $option)
            {
                $this->helper->json()->addOption($option);
            }
        }
        else
        {
            $this->helper->json()->setOption($options);
        }

        echo $this->helper->json()->encode($data);
        die;

    }

    /**
     * Check if the request is ajax
     *
     * @return bool
     */
    public function isAjax()
    {
        $httpXRequestedWith = $this->server('http_x_requested_with');
        $httpXRequestedWith = $this->normalizeLow($httpXRequestedWith);

        return $httpXRequestedWith === 'xmlhttprequest';
    }

    /**
     * @return bool
     */
    public function isDelete()
    {
        return $this->method() === 'DELETE';
    }

    /**
     * @return string
     */
    public function method()
    {
        return $this->server('request_method');
    }

    /**
     * @return bool
     */
    public function isHead()
    {
        return $this->method() === 'HEAD';
    }

    /**
     * @return bool
     */
    public function isPut()
    {
        return $this->method() === 'PUT';
    }

    /**
     * @return bool
     */
    public function isPatch()
    {
        return $this->method() === 'PATCH';
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->method() === 'POST';
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->method() === 'GET';
    }

}