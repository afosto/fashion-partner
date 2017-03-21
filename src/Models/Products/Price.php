<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\Bp\Exceptions\ValidationException;
use Afosto\FashionPartner\Components\Model;

/**
 * Class Price
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $priceCode
 * @property string $currency
 * @property float  $amount
 */
class Price extends Model {

    /**
     * Use as reference so we can obtain the validated values
     * @var Size
     */
    public $size;

    /**
     * Use as reference so we can obtain the validated values
     * @var Color
     */
    public $color;

    /**
     * @param       $price
     * @param Color $color
     * @param Size  $size
     *
     * @return Price
     */
    public static function getPrice($price, Color $color, Size $size) {
        $priceObject = new Price();
        $priceObject->amount = $price;
        $priceObject->priceCode = 'RT';
        $priceObject->currency = 'EUR';
        $priceObject->size = $size;
        $priceObject->color = $color;

        return $priceObject;
    }

    public function getRules() {
        return [
            ['priceCode', 'string', true, 2],
            ['currency', 'string', true, 3],
            ['amount', 'float', 'validateAmount'],
        ];
    }

    public function validateAmount() {
        if ($this->amount == 0) {
            throw new ValidationException('No valid amount set');
        }
        $this->validateDouble('amount');
    }

    public function getModel() {
        return array_merge([
            'sizeCode'  => $this->size->sizeCode,
            'colorCode' => $this->color->colorCode,
        ], parent::getModel());
    }
}