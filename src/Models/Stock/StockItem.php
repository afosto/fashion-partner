<?php

namespace Afosto\FashionPartner\Models\Stock;

use Afosto\FashionPartner\Components\Model;

/**
 * Class StockItem
 * @package Afosto\FashionPartner\Models\Stock
 * @property string $barcode
 * @property string $quantity
 */
class StockItem extends Model {

    public function getRules() {
        return [
            ['barcode', 'string', true],
            ['quantity', 'string', true],
        ];
    }

}