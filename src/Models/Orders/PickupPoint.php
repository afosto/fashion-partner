<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class PickupPoint
 * @package Afosto\FashionPartner\Models\Orders
 * @property string $id
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $postalCode
 * @property string $city
 * @property string $countryIso
 */
class PickupPoint extends Model {

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['id', 'string', true, 35],
            ['name', 'string', true, 35],
            ['street1', 'string', true, 35],
            ['street2', 'string', false, 35],
            ['postalCode', 'string', true, 10],
            ['city', 'string', true, 30],
            ['countryIso', 'string', true, 3],
        ];
    }

    /**
     * @return array
     */
    public function getMap() {
        return [
            'name'       => 'NAME',
            'street1'    => 'STREET1',
            'street2'    => 'STREET2',
            'postalCode' => 'ZIP_CODE',
            'city'       => 'CITY',
            'countryIso' => 'COUNTRY',
        ];
    }
}