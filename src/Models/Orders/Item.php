<?php
namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Item
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string  $ean
 * @property integer $amount
 * @property float   $price
 * @property string  $reason
 * @property string  $remark
 * @property Picture $pictures
 */
class Item extends Model {

    public function getRules() {
        return [
            ['ean', 'string', true],
            ['amount', 'integer', true],
            ['price', 'float', true],
            ['reason', 'string', false, 30],
            ['remark', 'string', false, 100],
            ['pictures', 'Picture[]', false],
        ];
    }

    public function getMap() {
        return [
            'ean'      => 'BARCODE',
            'amount'   => 'QTY',
            'price'    => 'PRICE',
            'reason'   => 'REASON',
            'remark'   => 'REMARK',
            'pictures' => 'PICTURES',

        ];
    }
}