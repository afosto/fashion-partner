<?php

namespace Afosto\FashionPartner\Models\Webhooks;

use Afosto\FashionPartner\Components\App;
use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Components\Operations\Push;

/**
 * Class Make
 * @package Afosto\FashionPartner\Models\Webhook
 *
 * @property integer $id
 */
class DeleteWebhook extends Model {

    use Push;

    /**
     * @return string
     */
    public function getMethod() {
        return 'deleteHook';
    }

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['id', 'integer', true, 256],
        ];
    }

    public function getMap() {
        return [
            'id' => 'idhook'
        ];
    }

    /**
     * @return array
     */
    public function getModel() {
        return [
            'DeleteHookRequest' => array_merge([
                'sessionId'   => App::getInstance()->getApi()->getSessionId(),
                'companyCode' => App::getInstance()->getApi()->getCompanyCode(),
            ], parent::getModel()),
        ];
    }

    /**
     * @param $result
     *
     * @return bool
     */
    protected function validateResult($result) {
        if ($result['return']['status'] == 0) {
            return true;
        }
        $this->errors[] = $result['return']['message'];

        return false;
    }
}