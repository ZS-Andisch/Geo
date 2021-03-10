<?php

namespace Foxliscom\Geo\Factories;

use Foxliscom\Geo\Entities\FoxlisGeoAccount;

class FoxlisGeoAccountFactory
{
    public function getFoxlisGeoAccountEntity()
    {
        return new FoxlisGeoAccount();
    }
}