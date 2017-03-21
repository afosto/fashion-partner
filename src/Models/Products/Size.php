<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Size
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $sizeCode
 * @property string $sizeLong
 *
 */
class Size extends Model {

    public function getRules() {
        return [
            ['sizeCode', 'string', true, 4],
            ['sizeLong', 'string', true, 10],
        ];
    }

}