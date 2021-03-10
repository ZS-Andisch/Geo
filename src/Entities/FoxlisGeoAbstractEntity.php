<?php

namespace Foxliscom\Geo\Entities;

abstract class FoxlisGeoAbstractEntity
{
    protected $foxlisGeo;
    protected $entity;

    /**
     * FoxlisGeoCity constructor.
     * @param FoxlisGeo $foxlisGeo
     */
    public function __construct(FoxlisGeo $foxlisGeo)
    {
        $this->foxlisGeo = $foxlisGeo;
    }
}
