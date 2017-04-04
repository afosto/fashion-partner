<?php

namespace Afosto\FashionPartner\Models\Orders;

use Afosto\Bp\Exceptions\ValidationException;
use Afosto\FashionPartner\Components\App;
use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Components\Operations\Push;
use Afosto\FashionPartner\Helpers\ShippingMethodHelper;

/**
 * Class Order
 * @package Afosto\FashionPartner\Models\Order
 *
 * @property string  $orderType
 * @property integer $orderId
 * @property string  $orderDate
 * @property string  $customerId
 * @property string  $deliveryAddressId
 * @property string  $salesRepresentativeNumber
 * @property string  $salesAgentNumber
 * @property string  $shippingAgent
 * @property string  $shippingMethod
 * @property string  $orderCategory
 * @property float   $shippingCost
 * @property string  $orderReference
 * @property string  $trackTraceNumber
 * @property integer $exchangeNumber
 * @property string  $deliverAtNeighbour
 * @property Contact $customer
 * @property Address $shipmentAddress
 * @property Item[]  $items
 */
class Order extends Model {

    use Push;

    /**
     * Default order type
     * @var string
     */
    const TYPE_ORDER = 'O';

    /**
     * Return order type
     * @var string
     */
    const TYPE_RETURN = 'R';

    /**
     * @var PickupPoint
     */
    private $_pickupPoint;

    /**
     * @var StoreAddress
     */
    private $_storeAddress;

    /**
     * Helper to set the order date in proper format
     *
     * @param \DateTime $dateTime
     */
    public function setOrderDate(\DateTime $dateTime) {
        $this->orderDate = $dateTime->format('d/m/Y');
    }

    /**
     * Returns the soap method to call
     * @return string
     */
    public function getMethod() {
        return 'CreateCustomerOrder';
    }

    /**
     * Return the mapping
     * @return array
     */
    public function getMap() {
        return [
            'orderType'                 => 'ORD_TYPE',
            'orderId'                   => 'ORD_NUM',
            'orderDate'                 => 'ORD_DATE',
            'customerId'                => 'CUS_CODE',
            'deliveryAddressId'         => 'DEL_CODE',
            'salesRepresentativeNumber' => 'SAL_REP',
            'salesAgentNumber'          => 'SA_AGENT',
            'shippingAgent'             => 'TRANSPORTER',
            'shippingMethod'            => 'DEL_TYPE',
            'orderCategory'             => 'ORD_CATEGORY',
            'shippingCost'              => 'TRANSPORT_COST',
            'orderReference'            => 'REFERENCE',
            'trackTraceNumber'          => 'TRACK_TRACE',
            'exchangeNumber'            => 'EXCHANGE_ORD_NUM',
            'deliverAtNeighbour'        => 'DELIVER_AT_NEIGHTBOURS',
            'customer'                  => 'CUSTOMER_DETAILS',
            'shipmentAddress'           => 'DELIVERY_ADDRESS',
            'items'                     => 'STYLES',

        ];
    }

    /**
     * Return the rules
     * @return array
     */
    public function getRules() {
        return [
            ['orderType', 'string', true],
            ['orderId', 'integer', true],
            ['orderDate', 'string', true, 10],
            ['customerId', 'string', true, 10],
            ['deliveryAddressId', 'string', false, 10],
            ['salesRepresentativeNumber', 'string', false, 10],
            ['salesAgentNumber', 'string', false, 10],
            ['shippingAgent', 'string', true, 'validateShippingAgent'],
            ['shippingMethod', 'string', false, 6],
            ['orderCategory', 'string', false, 1],
            ['shippingCost', 'float', false, 'validateTransportCost'],
            ['orderReference', 'string', false, 25],
            ['trackTraceNumber', 'string', false, 1024],
            ['exchangeNumber', 'integer', false],
            ['deliverAtNeighbour', 'string', false, 'validateDeliverNeighbours'],
            ['customer', 'Contact', true],
            ['shipmentAddress', 'Address', false],
            ['items', 'Item[]', true],
        ];
    }

    /**
     * Sets delivery address to pickup point
     *
     * @param PickupPoint $pickupPoint
     */
    public function setPickupPoint(PickupPoint $pickupPoint) {
        $this->_pickupPoint = $pickupPoint;
    }

    /**
     * Sets delivery address to store
     *
     * @param StoreAddress $address
     */
    public function setStoreDelivery(StoreAddress $address) {
        $this->_storeAddress = $address;
    }

    /**
     * Validate delivery
     */
    public function validateDeliverNeighbours() {
        if ($this->deliverAtNeighbour === true) {
            $this->deliverAtNeighbour = 'Y';
        }
    }

    /**
     * Validate the cost
     */
    public function validateTransportCost() {
        $this->shippingCost = number_format($this->shippingCost, 2, '.', null);
    }

    /**
     * Fix the model for this specific model
     *
     * @return array
     */
    public function getModel() {
        return [
            'sessionId'   => App::getInstance()->getApi()->getSessionId(),
            'companyCode' => App::getInstance()->getApi()->getCompanyCode(),
            'orders'      => [
                'ORDER' => parent::getModel(),
            ]];
    }

    /**
     * @throws ValidationException
     */
    public function validateShippingAgent() {
        if (!in_array($this->shippingAgent, ShippingMethodHelper::getShippingMethods())) {
            throw new ValidationException('Invalid shipping agent: ' . $this->shippingAgent . ' not one of ' . implode(', ', ShippingMethodHelper::getShippingMethods()));
        }
    }

    /**
     * Run some validation
     */
    public function beforeValidate() {
        if ($this->orderType === null) {
            $this->orderType = self::TYPE_ORDER;
        }

        if ($this->_pickupPoint !== null) {
            $this->shipmentAddress->setAttributes($this->_pickupPoint->getModel());
            $this->deliveryAddressId = $this->_pickupPoint->id;
        }

        if ($this->_storeAddress !== null) {
            $this->shipmentAddress->setAttributes($this->_storeAddress->getModel());
        }

        return parent::beforeValidate();
    }

    /**
     * Return the status of the call (saving an order)
     *
     * @param $result
     *
     * @return bool
     */
    protected function validateResult($result) {
        $status = -1;
        if (isset($result['return']) && isset($result['return']['orders']) && !empty($result['return']['orders'])) {
            $status = trim(current($result['return']['orders'])['status']);
            if (is_numeric($status)) {
                $status = (int)$status;
            }
        }

        if (isset($result['return']['orders'])) {
            foreach ($result['return']['orders'] as $order) {
                $this->errors[] = $order['message'];
            }
        }

        return ($status === 0);
    }

}