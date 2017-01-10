<?php

namespace DeimosTest;

use Deimos\Builder\Builder;
use Deimos\Helper\Helper;

class TestSetUp extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * @var Request
     */
    protected $request;

    protected function getConfig()
    {
        return require __DIR__ . '/config.php';
    }

    public function setUp()
    {

        $annotation = $this->getAnnotations();

        $_SERVER['HTTP_X_REQUESTED_WITH'] = null;
        if (isset($annotation['method']['ajax'][0]))
        {
            $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        }

        if (isset($annotation['method']['urlPath'][0]))
        {
            $_SERVER['REQUEST_URI'] = $annotation['method']['urlPath'][0];
        }

        $builder = new Builder();
        $this->helper = new Helper($builder);

        $this->request = new \DeimosTest\Request($this->helper);

        $config = $this->getConfig();

        $router = new \Deimos\Router\Router();

        $router->setRoutes($config);

        $this->request->setRouter($router);

    }

}
