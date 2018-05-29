<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class TrackTrace
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string       $customerOrderNumber
 * @property string       $trackAndTraceCode
 * @property string       $transporter
 * @property string       $boxNumber
 * @property string       $boxReference
 * @property ReturnItem[] $items
 */
class TrackTrace extends Model {

    /**
     * Return the mapping
     * @return array
     */
    public function getMap() {
        return [
            'items' => 'styleList'
        ];
    }

    public function getRules() {
        return [
            ['customerOrderNumber', 'string', true],
            ['trackAndTraceCode', 'string', true],
            ['transporter', 'string', true],
            ['boxNumber', 'string', false],
            ['boxReference', 'string', false],
            ['customer','integer', false],
            ['items', 'ReturnItem[]', true],
        ];
    }

}