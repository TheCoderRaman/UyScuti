<?php

namespace App\Utility\Urls;

class Atlas
{
    /**
     * Url itself.
     * 
     * @var string
     */
    protected string $url;

    /**
     * Additional url data.
     * 
     * @var array
     */
    protected array $data = [];

    /**
     * Url meta information.
     * 
     * @var array
     */
    protected array $meta = [];

    /**
     * Url itself.
     * 
     * @param string $url
     * @return $this
     */
    public function url(string $url)
    {
        $this->url = $url;

        return $this;
    }
    /**
     * Metas information of the url.
     * 
     * @param array $metas
     * @return $this
     */
    public function metas(array $metas)
    {
        $this->meta = $metas;

        return $this;
    }

    /**
     * Meta information of the url.
     * 
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function meta(string $key,$value)
    {
        $this->meta[$key] = $value;

        return $this;
    }

    /**
     * Data information of the url.
     * 
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function data(string $key,$value)
    {
        $this->data[$key] = $value;

        return $this;
    }
};