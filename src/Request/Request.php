<?php

namespace Deimos\Request;

class Request
{

    use AdapterExtension;
    use RequestExtension;

    /**
     * Request constructor.
     *
     * @param \Deimos\Helper\Helper $helper
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($helper)
    {
        if (!($helper instanceof \Deimos\Helper\Helper))
        {
            throw new \InvalidArgumentException('Helper not found!');
        }

        $this->helper = $helper;
    }

}