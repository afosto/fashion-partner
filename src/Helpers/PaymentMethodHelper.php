<?php

namespace Afosto\FashionPartner\Helpers;

class PaymentMethodHelper {

    const METHOD_BANCONTACT_MAESTRO = 'BCMA';

    const METHOD_VISA = 'VISA';

    const METHOD_MASTER_CARD_EURO = 'MCAR';

    const METHOD_MAESTRO = 'MAES';

    const METHOD_VISA_ELECTRON = 'VELE';

    const METHOD_V_PAY = 'VPAY';

    const METHOD_AMERICAN_EXPRESS = 'AMEX';

    const METHOD_GIFT_CARD = 'GICA';

    const METHOD_BANCONTACT = 'BCMC';

    /**
     * @param bool $filterImplemented
     *
     * @return array
     */
    public static function getMethods($filterImplemented = true) {
        $methods = [
            [
                'label'       => 'Banconcact/Maestro',
                'code'        => self::METHOD_BANCONTACT_MAESTRO,
                'implemented' => true,
            ],
            [
                'label'       => 'Visa',
                'code'        => self::METHOD_VISA,
                'implemented' => true,
            ],
            [
                'label'       => 'MasterCard (Eurocard)',
                'code'        => self::METHOD_MASTER_CARD_EURO,
                'implemented' => true,
            ],
            [
                'label'       => 'Maestro',
                'code'        => self::METHOD_MAESTRO,
                'implemented' => true,
            ],
            [
                'label'       => 'Visa Electron',
                'code'        => self::METHOD_VISA_ELECTRON,
                'implemented' => true,
            ],
            [
                'label'       => 'VPay',
                'code'        => self::METHOD_V_PAY,
                'implemented' => true,
            ],
            [
                'label'       => 'American Express',
                'code'        => self::METHOD_AMERICAN_EXPRESS,
                'implemented' => true,
            ],
            [
                'label'       => 'Gift Card',
                'code'        => self::METHOD_GIFT_CARD,
                'implemented' => true,
            ],
            [
                'label'       => 'Bancontact',
                'code'        => self::METHOD_BANCONTACT,
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

}