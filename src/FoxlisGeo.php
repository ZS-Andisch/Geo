<?php

namespace Foxliscom\Geo;

use Foxliscom\Geo\Services\FoxlisGeoService;

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
            $foxlisGeoService = new FoxlisGeoService(self::getConfig());
        }

        return $foxlisGeoService;
    }

    private static function getConfig()
    {
        if (!function_exists('getFoxlisGeoConfig_default')) {
            throw new \Exception('Foxlis Geo Plugin: config not found');
        }

        if (!function_exists('getFoxlisGeoConfig')) {
            return getFoxlisGeoConfig_default();
        }

        return array_merge(getFoxlisGeoConfig_default(), getFoxlisGeoConfig());
    }
}
