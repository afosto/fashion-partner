<?php

namespace Afosto\FashionPartner\Models\Products;

use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Helpers\Exceptions\ValidationException;

/**
 * Class Category
 * @package Afosto\FashionPartner\Models\Product
 *
 * @property string $name
 * @property string $value
 */
class Category extends Model {

    const CATEGORY_BRAND = 'BRAND';

    const CATEGORY_DEFAULT = 'CATEGORY';

    public function getRules() {
        return [
            ['name', 'string', 'validateCategory'],
            ['value', 'string', true, 20],
        ];
    }

    public function validateCategory() {
        if (!in_array($this->name, ['BRAND', 'CATEGORY'])) {
            throw new ValidationException('Category name is invalid');
        }
    }
}