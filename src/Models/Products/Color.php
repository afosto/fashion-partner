<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Color
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $colorCode
 * @property string $description
 */
class Color extends Model {

    public function getRules() {
        return [
            ['colorCode', 'string', true, 'validateColorCode'],
            ['description', 'string', false, 40],
        ];
    }

    public function validateColorCode() {
        $this->validateMaxLength('colorCode', 6);
        $this->colorCode = strtoupper($this->colorCode);
    }

}