<?php

namespace App\Utility\Crawler\Sniffer;

use App\Utility\Crawler\Sniffer\Types\Type;
use App\Utility\Crawler\Sniffer\Types\Site;
use App\Utility\Crawler\Sniffer\Types\Image;
use App\Utility\Crawler\Sniffer\Types\Video;
use App\Utility\Crawler\Sniffer\Types\Document;

class TypeSniffer
{
    /**
     * Current type for sniffer.
     * 
     * @var string
     */
    protected string $type;

    /**
     * Sniffer type detectors.
     * 
     * @var Type[]
     */
    protected $types = [
        Site::class,
        Image::class,
        Video::class,
        Document::class,
    ];

    /**
     * Type sniffer class constructor.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->registerCoreTypes();
    }

    /**
     * Sniffer analyzer given data/mime for type.
     * 
     * @param string $data
     * @return string|false
     */
    public function analyzer(string $data)
    {
        $types = collect($this->types)->map(
            fn($value) => array_values($value)[0]
        )->filter(fn($type) => (
                $type->analyse($data)
            )
        );

        return ((null === $types->first())
            ?false :$types->first()->getType()
        );
    }

    /**
     * Register new sniffer type.
     * 
     * @param Type|string $type
     * @return void
     */
    public function registerType(Type|string $type)
    {
        if(!$type instanceof Type){
            $type = app($type);
        }

        array_push($this->types,[
            $type->getIdentifer() => $type
        ]);
    }

    /**
     * Register core sniffer types.
     * 
     * @return void
     */
    protected function registerCoreTypes()
    {
        $this->types = (collect(
            $this->types
        )->map(fn($type) => app($type))
            ->map(fn($type) => (
                [$type->getIdentifer() => $type]
            ))
        );

        $this->types = $this->types->toArray();
    }
};