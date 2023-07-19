<?php

namespace App\Utility\Crawler\Sniffer\Types;

use App\Utility\Crawler\Sniffer\Types\Type;

final class Site extends Type
{
    /**
     * Type name.
     * 
     * @var string
     */
    protected string $type = 'site';

    /**
     * Type identifer.
     * 
     * @var string
     */
    protected string $identifer = 'type:site';

    /**
     * Analyse and try to match type.
     * 
     * @param mixed $data
     * @return bool
     */
    public function analyse($data)
    {
        $ext = $this->getExtension($data);

        if(in_array($ext,['html'])){
            return true;
        }
        
        return preg_match('/text\/[^+]*[+]?(html);?.*/',$data);
    }
};