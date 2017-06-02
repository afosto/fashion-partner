<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Address
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $postalCode
 * @property string $city
 * @property string $countryIso
 * @property string $email
 * @property string $phoneNumber
 */
class Address extends Model {

    public function getRules() {
        return [
            ['name', 'string', true, 35],
            ['additionalName', 'string', false, 35],
            ['street1', 'string', true, 100],
            ['street2', 'string', false, 35],
            ['postalCode', 'string', true, 10],
            ['city', 'string', true, 30],
            ['countryIso', 'string', true, 3],
            ['email', 'string', false, 50],
            ['phoneNumber', 'string', false, 20],
        ];
    }

    /**
     * @return array
     */
    public function getMap() {
        return [
            'name'           => 'NAME',
            'additionalName' => 'NAME2',
            'street1'        => 'STREET1',
            'street2'        => 'STREET2',
            'postalCode'     => 'ZIP_CODE',
            'city'           => 'CITY',
            'countryIso'     => 'COUNTRY',
            'email'          => 'EMAIL',
            'phoneNumber'    => 'PHONE',
        ];
    }

}