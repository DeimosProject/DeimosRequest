<?php

namespace Deimos\Request\Adapter;

trait Server
{

    private $serverData;

    /**
     * @param string $path
     * @param mixed  $default
     *
     * @return mixed
     */
    public function server($path = null, $default = null)
    {
        $path = $this->normalizeUpp($path);

        return $this->arrGet($this->serverData(), $path, $default);
    }

    private function serverData()
    {
        if (!$this->serverData)
        {
            $this->serverData = $this->inputArray(INPUT_SERVER);
        }

        return $this->serverData;
    }

}