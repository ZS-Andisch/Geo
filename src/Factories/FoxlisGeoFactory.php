<?php

namespace Foxliscom\Geo\Factories;

use Foxliscom\Geo\Entities\FoxlisGeo;

class FoxlisGeoFactory
{
    public function getFoxlisGeoEntity()
    {
        return new FoxlisGeo();
    }
}