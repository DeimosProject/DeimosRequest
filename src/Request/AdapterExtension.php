<?php

namespace Deimos\Request;

trait AdapterExtension
{

    use DefaultAdapter;

    private $allowMethods = [
        'attribute' => true,
        'get'       => true,
        'query'     => true,
        'post'      => true,
        'data'      => true,
        'put'       => true,
        'patch'     => true,
        'delete'    => true,
    ];

    /**
     * @var array
     */
    private $filters = [
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
    private $defaults = [
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

        if (empty($this->allowMethods[$call]))
        {
            throw new \BadFunctionCallException('Not found' . $name);
        }

        if ($filter === 'unsafe')
        {
            $arguments[1] = isset($arguments[1]) ? $arguments[1] : null;
            $arguments[2] = false;

            return call_user_func_array([$this, $call], $arguments);
        }

        return $this->filterVariable(
            call_user_func_array([$this, $call], $arguments),
            $this->filters[$filter],
            $this->defaults[$filter]
        );
    }

}