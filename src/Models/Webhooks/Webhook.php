<?php

namespace Afosto\FashionPartner\Models\Webhooks;

use Afosto\FashionPartner\Components\App;
use Afosto\Bp\Exceptions\ValidationException;
use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Components\Operations\Create;

/**
 * Class Make
 * @package Afosto\FashionPartner\Models\Webhook
 *
 * @property string $name
 * @property string $event
 * @property string $address
 */
class Webhook extends Model {

    use Create;

    /**
     * Stock hook type
     */
    const HOOK_STOCK = 'style.stock';

    /**
     * TrackTrace hook type
     */
    const HOOK_TRACK_TRACE = 'customer.order.trackandtrace';

    /**
     * Todo
     */
    const HOOK_ORDER_RETURN = 'customer.return';

    /**
     * Todo
     */
    const HOOK_ORDER_CANCEL_CONFIRM = 'customer.order.annulation';

    /**
     * @return string
     */
    public function getMethod() {
        return 'CreateNewHook';
    }

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['name', 'string', true, 256],
            ['event', 'string', true, 'validateEvent'],
            ['address', 'string', true, 'validateAddress'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validateEvent() {
        if (!in_array($this->event, ['style.stock', 'customer.order.trackandtrace', 'customer.return', 'customer.order.annulation'])) {
            throw new ValidationException('Invalid event type');
        }
    }

    /**
     * @throws ValidationException
     */
    public function validateAddress() {
        if (filter_var($this->address, FILTER_VALIDATE_URL) === false) {
            throw new ValidationException('Invalid address, is not valid url');
        }
    }

    /**
     * @return array
     */
    public function getModel() {
        return [
            'CreateNewHookRequest' => array_merge([
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
        if ($result['return']['status'] == 1) {
            return true;
        }
        $this->errors[] = $result['return']['message'];

        return false;
    }
}