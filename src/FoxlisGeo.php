<?php

namespace Foxliscom\Geo;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

use Foxliscom\Geo\Services\FoxlisGeoService;

class FoxlisGeo implements PluginInterface
{
    private static $extra = [];

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
                self::$extra['params']
            );
        }

        return $foxlisGeoService;
    }

    public function activate(Composer $composer, IOInterface $io)
    {
        self::$extra = $composer->getPackage()->getExtra();
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}
