<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class ReturnOrder
 * @package Afosto\FashionPartner\Models\Orders
 *
 * @property string       $orderId
 * @property integer      $returnCancelNumber
 * @property ReturnItem[] $items
 */
class CancelOrder extends Model
{

    /**
     * Return the mapping
     * @return array
     */
    public function getMap() {
        return [
            'orderId'            => 'customerOrderNumber',
            'returnCancelNumber' => 'customerOrderAnnulationNumber',
            'items'              => 'styleList',
        ];
    }

    /**
     * Return the rules
     * @return array
     */
    public function getRules() {
        return [
            ['orderId', 'string', true],
            ['returnCancelNumber', 'string', true],
            ['items', 'ReturnItem[]', true],
        ];
    }

}