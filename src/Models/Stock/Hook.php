<?php

namespace Afosto\FashionPartner\Models\Stock;

/**
 * Class Hook
 * @package Afosto\FashionPartner\Models\Stock
 *
 * @property integer $idhook
 * @property string $company
 * @property string $name
 * @property string $event
 * @property string $eventTime
 * @property Stock[] $list
 */
class Hook extends StockList {

    public function getRules() {
        return array_merge([
            ['idhook', 'integer', true],
            ['company', 'string', true],
            ['name', 'string', true],
            ['event', 'string', true],
            ['eventTime', 'string', true],
        ], parent::getRules());
    }

}