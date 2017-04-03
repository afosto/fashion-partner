<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\App;
use Afosto\FashionPartner\Components\Model;
use Afosto\Bp\Exceptions\ValidationException;
use Afosto\FashionPartner\Components\Operations\Push;

/**
 * Class Create
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string      $style             Manufacturing part number
 * @property string      $variant           Parent product id (should be the same for all variants)
 * @property string      $season
 * @property string      $type
 * @property string      $description1      Product name
 * @property string      $description2      Parent product id
 * @property string      $description3      Product short description
 * @property string      $description4      Product category specification
 * @property float       $vatPercent
 * @property string      $intrastat
 * @property float       $weight
 * @property Composition $composition
 * @property string      $note
 * @property Category[]  $categories
 * @property Color[]     $colors
 * @property Size[]      $sizes
 * @property Barcode[]   $barcodes
 * @property Picture[]   $pictures
 * @property Price[]     $prices
 * @property Remark[]    $remarks
 */
class Product extends Model {

    use Push;

    /**
     * Insert a product variant
     *
     * @param      $barcode
     * @param      $colorCode
     * @param      $sizeCode
     * @param      $price
     * @param null $colorLabel
     * @param null $sizeLabel
     */
    public function addVariant($barcode, $colorCode, $sizeCode, $price, $colorLabel = null, $sizeLabel = null) {
        $sizeObject = new Size();
        $sizeObject->sizeCode = $sizeCode;
        $sizeObject->sizeLong = ($sizeLabel === null) ? $sizeCode : $sizeLabel;

        $colorObject = new Color();
        $colorObject->colorCode = $colorCode;
        $colorObject->description = ($colorLabel === null) ? $colorCode : $colorLabel;

        $this->sizes[] = $sizeObject;

        $isNew = true;
        foreach ($this->colors as $currentColor) {
            if ($currentColor->colorCode == $colorCode) {
                $isNew = false;
            }
        }

        if ($isNew) {
            $this->colors[] = $colorObject;
        }
        $this->prices[] = Price::getPrice($price, $colorObject, $sizeObject);
        $this->barcodes[] = Barcode::getBarcode($colorObject, $sizeObject, $barcode);
    }

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['style', 'string', true, 20],
            ['variant', 'string', true, 15],
            ['season', 'string', 'validateSeason'],
            ['type', 'string', false, 1],
            ['description1', 'string', false, 30],
            ['description2', 'string', false, 30],
            ['description3', 'string', false, 30],
            ['description4', 'string', false, 30],
            ['vatPercent', 'float', false, 'validateVat'],
            ['intrastat', 'string', false, 12],
            ['weight', 'float', false, 'validateWeight'],
            ['composition', 'Composition', false],
            ['note', 'string', false, 2048],
            ['categories', 'Category[]', false],
            ['colors', 'Color[]', false],
            ['sizes', 'Size[]', true],
            ['barcodes', 'Barcode[]', false],
            ['pictures', 'Picture[]', false],
            ['prices', 'Price[]', true],
            ['remarks', 'Remark[]', false],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validateVat() {
        if ($this->vatPercent > 99) {
            throw new ValidationException('Vat is invalid');
        }
        $this->validateDouble('vatPercent');
    }

    /**
     * @throws ValidationException
     */
    public function validateWeight() {
        if ((int)$this->weight > 999999) {
            throw new ValidationException('Weight is too heavy');
        }
        $this->weight = number_format($this->weight, 3, '.', '');
    }

    /**
     * Make sure the value is set to ALL
     */
    public function validateSeason() {
        $this->season = 'ALL';
    }

    /**
     * @return array
     */
    public function getModel() {
        return [
            'sessionId'   => App::getInstance()->getApi()->getSessionId(),
            'companyCode' => App::getInstance()->getApi()->getCompanyCode(),
            'styleList'   => [
                'styleDetail' => parent::getModel(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function getMethod() {
        return 'CreateStyle';
    }

    /**
     * @param $result
     *
     * @return bool
     */
    protected function validateResult($result) {
        if ($result['return']['status'] == 0) {
            $count = 0;
            if (isset($result['return']['styles']['style']['barcodes']['barcode']['colorCode'])) {
                $count = 1;
            } else {
                @$count = count($result['return']['styles']['style']['barcodes']['barcode']);
            }

            if ($count === count($this->barcodes)) {
                return true;
            }
        }

        if (isset($result['return']['styles'])) {
            foreach ($result['return']['styles'] as $style) {
                $this->errors[] = $style['message'];
            }
        }

        return false;
    }
}