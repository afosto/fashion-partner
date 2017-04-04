<?php

namespace Afosto\FashionPartner\Helpers;

class ShippingMethodHelper {

    const METHOD_POST_NL = 'PNL';

    const METHOD_POST_NL_PAKJEGEMAK = 'PNLPL';

    const METHOD_DHL = 'SVR';

    const METHOD_DNL_PICKUP_POINT = 'SVRPS';

    /**
     * Return an array of supported shipping methods and their codes
     *
     * @return array
     */
    public static function getShippingMethods() {
        return [
            'PostNL Standaard'  => self::METHOD_POST_NL,
            'PostNL Pakjegemak' => self::METHOD_POST_NL_PAKJEGEMAK,
            'DHL Standaard'     => self::METHOD_DHL,
            'DHL Pickup Point'  => self::METHOD_DNL_PICKUP_POINT,
        ];
    }

}