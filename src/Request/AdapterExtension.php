<?php

namespace Deimos\Request;

trait AdapterExtension
{

    use DefaultAdapter;

    private static $allowMethods = [
        'attributes' => true,
        'get'        => true,
        'query'      => true,
        'post'       => true,
        'data'       => true,
        'put'        => true,
        'patch'      => true,
        'delete'     => true,
    ];

    /**
     * @var array
     */
    private static $filters = [
        'int'   => FILTER_VALIDATE_INT,
        'float' => FILTER_VALIDATE_FLOAT,
        'bool'  => FILTER_VALIDATE_BOOLEAN,
        'email' => FILTER_VALIDATE_EMAIL,
        'ip'    => FILTER_VALIDATE_IP,
        'url'   => FILTER_VALIDATE_URL,
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'int'   => 0,
        'float' => .0,
        'bool'  => false,
        'email' => '',
        'ip'    => '',
        'url'   => '',
    ];

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     *
     * @throws \BadFunctionCallException
     */
    public function __call($name, $arguments)
    {
        $parameters = preg_replace('~([A-Z])~', '_$1', $name, 1);

        $parameters = $this->normalizeLow($parameters);
        list ($call, $filter) = explode('_', $parameters);

        $call = $call === 'attribute' ? 'attributes' : $call;

        if (empty(static::$allowMethods[$call]))
        {
            throw new \BadFunctionCallException('Not found' . $name);
        }

        return $this->filterVariable(
            call_user_func_array([$this, $call], $arguments),
            static::$filters[$filter],
            static::$defaults[$filter]
        );
    }

}