<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Contact
 * @package Afosto\FashionPartner\Models\Order
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $postalCode
 * @property string $city
 * @property string $countryIso
 * @property string $email
 * @property string $phoneNumber
 * @property string $languageIso
 */
class Contact extends Model {

    public function getRules() {
        return [
            ['name', 'string', true, 35],
            ['street1', 'string', true, 35],
            ['street2', 'string', false, 35],
            ['postalCode', 'string', true, 10],
            ['city', 'string', true, 30],
            ['countryIso', 'string', true, 3],
            ['email', 'string', false, 50],
            ['phoneNumber', 'string', false, 20],
            ['languageIso', 'string', false, 2],
        ];
    }

    /**
     * @return array
     */
    public function getMap() {
        return [
            'name'        => 'NAME',
            'street1'     => 'STREET1',
            'street2'     => 'STREET2',
            'postalCode'  => 'ZIP_CODE',
            'city'        => 'CITY',
            'countryIso'  => 'COUNTRY',
            'email'       => 'EMAIL',
            'phoneNumber' => 'PHONE1',
            'languageIso' => 'LANGUAGE',

        ];
    }

    public function setAddress(Address $address) {
        $this->setAttributes($address);
    }

}