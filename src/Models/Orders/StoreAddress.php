<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class StoreAddress
 * @package Afosto\FashionPartner\Models\Orders
 *
 * @property string $storeName
 * @property string $customerName
 * @property string $storeStreet1
 * @property string $storeStreet2
 * @property string $storePostalCode
 * @property string $storeCity
 * @property string $storeCountryIso
 */
class StoreAddress extends Model {

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['storeName', 'string', true, 35],
            ['customerName', 'string', true, 35],
            ['storeStreet1', 'string', true, 100],
            ['storeStreet2', 'string', false, 35],
            ['storePostalCode', 'string', true, 10],
            ['storeCity', 'string', true, 30],
            ['storeCountryIso', 'string', true, 3],
        ];
    }

    /**
     * @return array
     */
    public function getMap() {
        return [
            'storeName'       => 'NAME',
            'customerName'    => 'NAME2',
            'storeStreet1'    => 'STREET1',
            'storeStreet2'    => 'STREET2',
            'storePostalCode' => 'ZIP_CODE',
            'storeCity'       => 'CITY',
            'storeCountryIso' => 'COUNTRY',
        ];
    }
}