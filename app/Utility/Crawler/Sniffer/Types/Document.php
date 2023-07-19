<?php

namespace App\Utility\Crawler\Sniffer\Types;

use App\Utility\Crawler\Sniffer\Types\Type;

final class Document extends Type
{
    /**
     * Type name.
     * 
     * @var string
     */
    protected string $type = 'document';

    /**
     * Type identifer.
     * 
     * @var string
     */
    protected string $identifer = 'type:document';

    /**
     * Analyse and try to match type.
     * 
     * @param mixed $data
     * @return bool
     */
    public function analyse($data)
    {
        $supported = [
            'doc','docx','otd',
            'pdf','xls','xlsx',
            'ppt','pptx','zip',
            'txt','7z','rar','gz',"dat"
        ];

        $ext = $this->getExtension($data);

        return in_array($ext,$supported);
    }
};