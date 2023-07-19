<?php

namespace App\Utility\Crawler\Sniffer\Types;

use App\Utility\Crawler\Sniffer\Types\Type;

final class Video extends Type
{
    /**
     * Type name.
     * 
     * @var string
     */
    protected string $type = 'video';

    /**
     * Type identifer.
     * 
     * @var string
     */
    protected string $identifer = 'type:video';

    /**
     * Analyse and try to match type.
     * 
     * @param mixed $data
     * @return bool
     */
    public function analyse($data)
    {
        $supported = [
            'mp4','webm','3gp','mp4','mpeg','ogg'
        ];

        $ext = $this->getExtension($data);

        if(in_array($ext,$supported)){
            return true;
        }
        
        return preg_match(
            "/(video|x-(?:[0-9A-Za-z!#$%&'*+.^_`|~-]+))\/([0-9A-Za-z!#$%&'*+.^_`|~-]+)/",$data
        );
    }
};