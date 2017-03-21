<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Picture
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $description
 * @property string $url
 */
class Picture extends Model {

    public function getRules() {
        return [
            ['description', 'string', false, 20],
            ['url', 'string', true],
        ];
    }

}