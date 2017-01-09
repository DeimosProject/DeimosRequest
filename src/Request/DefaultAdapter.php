<?php

namespace Deimos\Request;

use Deimos\Helper\Exceptions\ExceptionEmpty;

trait DefaultAdapter
{

    /**
     * @var \Deimos\Helper\Helper
     */
    protected $helper;
    private   $input = 'php://input';

    /**
     * @param string $type
     *
     * @return mixed
     */
    protected function inputArray($type)
    {
        return filter_input_array($type, FILTER_UNSAFE_RAW) ?: [];
    }

    /**
     * @return array
     */
    protected function getInput()
    {
        $contents = $this->getContents($this->input);

        return $this->parseStr($contents);
    }

    /**
     * @param string $data
     *
     * @return string
     */
    private function getContents($data)
    {
        return file_get_contents($data);
    }

    /**
     * @param string $data
     *
     * @return array
     */
    private function parseStr($data)
    {
        parse_str($data, $output);

        return $output;
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function normalizeUpp($string)
    {
        return strtoupper($string);
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function normalizeLow($string)
    {
        return strtolower($string);
    }

    /**
     * @param array  $storage
     * @param string $path
     * @param bool   $xss
     *
     * @return mixed
     *
     * @throws ExceptionEmpty
     */
    protected function arrRequired(array $storage, $path, $xss)
    {
        $data = $this->helper->arr()->getRequired($storage, $path);

        if ($xss)
        {
            $data = $this->xss($data);
        }

        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    protected function xss($data)
    {
        if (is_array($data))
        {
            return filter_var_array($data, FILTER_SANITIZE_STRING);
        }

        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    /**
     * @param array  $storage
     * @param string $path
     * @param mixed  $default
     * @param bool   $xss
     *
     * @return mixed
     */
    protected function arrGetXss(array $storage, $path, $default, $xss)
    {
        $data = $this->arrGet($storage, $path, $default);

        if ($xss && !empty($data))
        {
            $data = $this->xss($data);
        }

        return $data;
    }

    /**
     * @param array  $storage
     * @param string $path
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function arrGet(array $storage, $path, $default)
    {
        if ($path === null)
        {
            return $storage;
        }

        return $this->helper->arr()->get($storage, $path, $default);
    }

    /**
     * @param $data
     * @param $type
     * @param $default
     *
     * @return mixed
     */
    protected function filterVariable($data, $type, $default)
    {
        return filter_var($data, $type, array(
            'options' => array('default' => $default)
        ));
    }

}