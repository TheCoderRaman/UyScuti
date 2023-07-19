<?php

namespace App\Utility\Crawler;

use \Exception;
use Pdp\Domain;
use Illuminate\Support\Facades\Log;
use Bakame\Laravel\Pdp\Facades\Rules;

class DomainParser
{
    /**
     * Get url domain details.
     * 
     * @param string $url
     * @return array
     */
    public static function getDetails(string $url)
    {
        try {
            return self::parseDomain($url);
        } catch(Exception $e){
            Log::error(sprintf(
                "Domain Parser Error Caught: [code:%s] %s",
                $e->getCode(),$e->getMessage()),$e->getTrace()
            );
        }

        return [];
    }

    /**
     * Parse details from given domain url.
     * 
     * @param string $url
     * @return array
     */
    public static function parseDomain(string $url)
    {
        $url = parse_url($url)['host'] ?? '';

        $Resolved = Rules::resolve(
            Domain::fromIDNA2008($url)
        );
        
        return [
            'isIANA' => $Resolved->suffix()->isICANN(),
            'suffix' => $Resolved->suffix()->toString(),
            'domain' => $Resolved->domain()->toString(),
            'subDomain' => $Resolved->subDomain()->toString(),
            'secondLevelDomain' => $Resolved->secondLevelDomain()->toString(),
            'registrableDomain' => $Resolved->registrableDomain()->toString()
        ];
    }
};