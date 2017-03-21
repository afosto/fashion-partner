<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Picture
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string $url
 */
class Picture extends Model {

    public function getRules() {
        return [
            ['url', 'string', true],
        ];
    }

    public function getMap() {
        return [
            'url' => 'URL',
        ];
    }
}