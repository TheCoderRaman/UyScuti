<?php

namespace App\Utility\Crawler\Sniffer\Types;

use App\Utility\Crawler\Sniffer\Types\Type;

final class Image extends Type
{
    /**
     * Type name.
     * 
     * @var string
     */
    protected string $type = 'image';

    /**
     * Type identifer.
     * 
     * @var string
     */
    protected string $identifer = 'type:image';

    /**
     * Analyse and try to match type.
     * 
     * @param mixed $data
     * @return bool
     */
    public function analyse($data)
    {
        $supported = [
            'jpg','jpeg','png','webp','svg','gif'
        ];

        $ext = $this->getExtension($data);

        if(in_array($ext,$supported)){
            return true;
        }
        
        return preg_match(
            "/(image|x-(?:[0-9A-Za-z!#$%&'*+.^_`|~-]+))\/([0-9A-Za-z!#$%&'*+.^_`|~-]+)/",$data
        );
    }
};