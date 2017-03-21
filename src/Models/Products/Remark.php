<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Remark
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $type
 * @property string $description
 */
class Remark extends Model {

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['type', 'string', false, 'validateType'],
            ['description', 'string', true, 1000],
        ];
    }

    /**
     * Make sure the type is set
     */
    public function validateType() {
        $this->type = 'REM';
    }

}