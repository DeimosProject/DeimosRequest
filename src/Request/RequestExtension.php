<?php

namespace Deimos\Request;

trait RequestExtension
{

    use Adapter\Server;
    use Adapter\Router;
    use Adapter\Query;
    use Adapter\Data;

    /**
     * @param array     $data
     * @param int|array $options
     *
     * @return string
     */
    public function json(array $data = array(), $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    {

        if (!headers_sent())
        {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Tue, 19 May 1981 18:00:00 GMT');
            header('Content-type: application/json; charset=utf-8');
        }

        /**
         * @var \Deimos\Helper\Helpers\Json $json
         */
        $json = $this->helper->json();
        $json->setOption((array)$options);

        return $json->encode($data);

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