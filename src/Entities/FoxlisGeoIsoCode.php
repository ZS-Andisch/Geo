<?php

namespace Foxliscom\Geo\Entities;

class FoxlisGeoIsoCode extends FoxlisGeoAbstractEntity
{
    public function __toString()
    {
        $data = $this->foxlisGeo->getData();

        return isset($data['country']['iso_code']) ? trim($data['country']['iso_code']) : '';
    }

    public function __get($name)
    {
        $data = $this->foxlisGeo->getData();
        return isset($data['country']['iso_code']) ? trim($data['country']['iso_code']) : '';
    }
}
