<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Composition
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $description
 */
class Composition extends Model {

    public function getRules() {
        return [
            ['description', 'string', true, 300]
        ];
    }
}