<?php

namespace Deimos\Request;

use Deimos\Helper\Helper;

class Request
{

    use AdapterExtension;
    use RequestExtension;

    /**
     * Request constructor.
     *
     * @param Helper $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

}