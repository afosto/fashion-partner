<?php

namespace Afosto\FashionPartner\Helpers;

class ShippingMethodHelper {

    const METHOD_POST_NL = 'PNL';

    const METHOD_POST_NL_PAKJEGEMAK = 'PNLPL';

    const METHOD_DHL = 'SVR';

    const METHOD_DHL_PICKUP_POINT = 'SVRPS';

    const METHOD_DPD = 'DPD';

    /**
     * @param bool $filterImplemented
     *
     * @return array
     */
    public static function getMethods($filterImplemented = true) {
        $methods = [
            [
                'label'       => 'PostNL Standaard',
                'code'        => self::METHOD_POST_NL,
                'implemented' => true,
            ],
            [
                'label'       => 'PostNL Pakjegemak',
                'code'        => self::METHOD_POST_NL_PAKJEGEMAK,
                'implemented' => true,
            ],
            [
                'label'       => 'DHL Standaard',
                'code'        => self::METHOD_DHL,
                'implemented' => true,
            ],
            [
                'label'       => 'DHL Pickup Point',
                'code'        => self::METHOD_DHL_PICKUP_POINT,
                'implemented' => true,
            ],
            [
                'label'       => 'DPD',
                'code'        => self::METHOD_DPD,
                'implemented' => true,
            ],
        ];
        if ($filterImplemented) {
            $methods = array_filter($methods, function ($value) {
                return $value['implemented'];
            });
        }

        return $methods;
    }

    /**
     * @param $code
     *
     * @return bool
     */
    public static function isValid($code) {
        foreach (self::getMethods() as $method) {
            if ($method['code'] == $code) {
                return true;
            }
        }

        return false;
    }

}