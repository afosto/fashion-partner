<?php
namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Payment
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string $code
 * @property string $description
 * @property double $amount
 * @property double $vat_amount
 * @property string $remark
 */
class Payment extends Model {

    public function getRules() {
        return [
            ['code', 'string', true, 4],
            ['description', 'string', false, 1024],
            ['amount', 'double', false],
            ['vat_amount', 'double', false],
            ['remark', 'string', false, 60],
        ];
    }

    public function getMap() {
        return [
            'code'        => 'CODE',
            'description' => 'DESCRIPTION',
            'amount'      => 'AMOUNT',
            'vat_amount'  => 'VAT_AMOUNT',
            'remark'      => 'REMARK',

        ];
    }

    public function beforeValidate() {
        if ($this->amount !== null) {
            $this->validateDouble('amount');
        }

        if ($this->vat_amount !== null) {
            $this->validateDouble('vat_amount');
        }

        return parent::beforeValidate();
    }
}