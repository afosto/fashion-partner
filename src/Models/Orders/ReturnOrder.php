<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class ReturnOrder
 * @package Afosto\FashionPartner\Models\Orders
 *
 * @property string       $orderId
 * @property integer      $returnOrderNumber
 * @property string       $orderReference
 * @property ReturnItem[] $items
 */
class ReturnOrder extends Model {

    /**
     * Return the mapping
     * @return array
     */
    public function getMap() {
        return [
            'orderId'           => 'customerReturnForcastNumber',
            'returnOrderNumber' => 'customerReturnNumber',
            'orderReference'    => 'customerOrderNumber',
            'items'             => 'styleList',
        ];
    }

    /**
     * Return the rules
     * @return array
     */
    public function getRules() {
        return [
            ['orderId', 'string', true],
            ['returnOrderNumber', 'integer', true],
            ['orderReference', 'string', false, 25],
            ['items', 'ReturnItem[]', true],
        ];
    }

}