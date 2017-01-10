<?php

namespace DeimosTest;

class Request extends \Deimos\Request\Request
{

    protected function inputArray($type)
    {
        switch ($type)
        {
            case INPUT_GET:
                return $_GET;
            case INPUT_POST:
                return $_POST;
            case INPUT_SERVER:
                return $_SERVER;
        }
    }

    protected function getInput()
    {
        return $_REQUEST;
    }

}