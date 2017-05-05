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

    const METHOD_I_DEAL = 'IDEA';

    const METHOD_SOFORT = 'SOFO';

    const METHOD_GIROPAY = 'GIRO';

    const METHOD_KLARNA = 'KLAR';

    const METHOD_FASHION_CHEQUE = 'FACH';

    const METHOD_PAYPAL = 'PAYP';

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
            [
                'label'       => 'iDeal',
                'code'        => self::METHOD_I_DEAL,
                'implemented' => true,
            ],
            [
                'label'       => 'Sofort',
                'code'        => self::METHOD_SOFORT,
                'implemented' => true,
            ],
            [
                'label'       => 'GiroPay',
                'code'        => self::METHOD_GIROPAY,
                'implemented' => true,
            ],
            [
                'label'       => 'Klarna',
                'code'        => self::METHOD_KLARNA,
                'implemented' => true,
            ],
            [
                'label'       => 'FashionCheque',
                'code'        => self::METHOD_FASHION_CHEQUE,
                'implemented' => true,
            ],
            [
                'label'       => 'PayPal',
                'code'        => self::METHOD_PAYPAL,
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