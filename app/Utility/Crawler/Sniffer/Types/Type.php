<?php

namespace App\Utility\Crawler\Sniffer\Types;

abstract class Type
{
    /**
     * Type name.
     * 
     * @var string
     */
    protected string $type;

    /**
     * Type identifer.
     * 
     * @var string
     */
    protected string $identifer;

    /**
     * Get type.
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Get type identifer.
     * 
     * @return string
     */
    public function getIdentifer()
    {
        return $this->identifer;
    }

    /**
     * Get extension from the url/path.
     * 
     * @param string $path
     * @return string|null
     */
    public function getExtension(string $path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * Analyse and try to match type.
     * 
     * @param mixed $data
     * @return bool
     */
    abstract public function analyse($data);
};