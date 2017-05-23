<?php
/**
 * Created by PhpStorm.
 * User: peterbakker
 * Date: 23-05-17
 * Time: 14:42
 */

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class ReturnHook
 * @package Afosto\FashionPartner\Models\Orders
 *
 * @property integer       $idhook
 * @property string        $company
 * @property string        $name
 * @property string        $event
 * @property string        $eventTime
 * @property ReturnOrder[] $list
 */
class ReturnHook extends Model {

    public function getRules() {
        return [
            ['idhook', 'integer', true],
            ['company', 'string', true],
            ['name', 'string', true],
            ['event', 'string', true],
            ['eventTime', 'string', true],
            ['list', 'ReturnOrder[]', true],
        ];
    }

}