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

    public function getConfig()
    {
        return __DIR__ . '/config.php';
    }

    public function setUp()
    {

        $builder = new Builder();
        $this->helper = new Helper($builder);

    }

}