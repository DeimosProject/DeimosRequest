<?php

/**
 * @var $loader \Composer\Autoload\ClassLoader
 */
$loader = require dirname(__DIR__) . '/vendor/autoload.php';

$loader->addPsr4('DeimosTest\\', 'tests/src/');

if (class_exists('PHPUnit\\Framework\\TestCase'))
{
    class PHPUnit_Framework_TestCase extends \PHPUnit\Framework\TestCase
    {

    }
}