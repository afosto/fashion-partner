<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class Hook
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property integer      $idhook
 * @property string       $company
 * @property string       $name
 * @property string       $event
 * @property string       $eventTime
 * @property TrackTrace[] $list
 */
class Hook extends Model {

    public function getRules() {
        return [
            ['idhook', 'integer', true],
            ['company', 'string', true],
            ['name', 'string', true],
            ['event', 'string', true],
            ['eventTime', 'string', true],
            ['list', 'TrackTrace[]', true],
        ];
    }

}