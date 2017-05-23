<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class ReturnItem
 * @package Afosto\FashionPartner\Models\Orders
 * @property string  $ean
 * @property integer $amount
 */
class ReturnItem extends Model {

    public function getRules() {
        return [
            ['ean', 'string', true],
            ['amount', 'integer', true],
        ];
    }

    public function getMap() {
        return [
            'ean'    => 'barcode',
            'amount' => 'quantity',
        ];
    }

}