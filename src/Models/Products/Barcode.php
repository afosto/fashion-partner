<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Barcode
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $code
 */
class Barcode extends Model {

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
     * @param Color $color
     * @param Size  $size
     * @param       $barcode
     *
     * @return Barcode
     */
    public static function getBarcode(Color $color, Size $size, $barcode) {
        $barcodeObject = new Barcode();
        $barcodeObject->color = $color;
        $barcodeObject->size = $size;
        $barcodeObject->code = $barcode;

        return $barcodeObject;
    }

    public function getRules() {
        return [
            ['code', 'string', false],
        ];
    }

    public function getModel() {
        return [
            'sizeCode'  => $this->size->sizeCode,
            'colorCode' => $this->color->colorCode,
            'code'      => '',
            'codeChar'  => $this->code,
        ];
    }

}