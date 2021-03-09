<?php

namespace Foxlis\Geo;

use Foxlis\Geo\Services\FoxlisGeoService;

class FoxlisGeo
{
    public static function location()
    {
        return self::getService()->getFoxlisGeo();
    }

    public static function account()
    {
        return self::getService()->getFoxlisGeoAccount();
    }

    private static function getService()
    {
        static $foxlisGeoService;

        if (empty($foxlisGeoService)) {
            $foxlisGeoService = new FoxlisGeoService(
                include_once 'Config/common.php'
            );
        }

        return $foxlisGeoService;
    }
}
