<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\FashionPartner\Components\Model;

/**
 * Class TrackTrace
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string $customerOrderNumber
 * @property string $trackAndTraceCode
 * @property string $transporter
 */
class TrackTrace extends Model {

    public function getRules() {
        return [
            ['customerOrderNumber', 'string', true],
            ['trackAndTraceCode', 'string', true],
            ['transporter', 'string', true],
        ];
    }



}