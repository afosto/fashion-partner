<?php

namespace Afosto\FashionPartner\Models\Stock;

use Afosto\FashionPartner\Components\Model;

/**
 * Class StockList
 * @package Afosto\FashionPartner\Models\Stock
 *
 * @property StockItem[] $list
 */
class StockList extends Model {

    public function getRules() {
        return [
            ['list', 'StockItem[]', true],
        ];
    }

}