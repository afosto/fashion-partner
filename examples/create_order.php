<?php

require_once 'vendor/autoload.php';

\Afosto\FashionPartner\Components\App::init($config);

$address = new \Afosto\FashionPartner\Models\Orders\Address();
$address->city = 'Groningen';
$address->countryIso = 'NL';
$address->email = 'peter@afosto.com';
$address->name = 'Peter Bakker';
$address->phoneNumber = '0507119520';
$address->street1 = 'Grondzijl 16';
$address->postalCode = '9731DG';

$contact = new \Afosto\FashionPartner\Models\Orders\Contact();
$contact->setAddress($address);
$contact->languageIso = 'NL';

$item = new \Afosto\FashionPartner\Models\Orders\Item();
$item->ean = '1009200912346';
$item->amount = 1;
$item->price = 15.95;

$model = new \Afosto\FashionPartner\Models\Orders\Order();
$model->setOrderDate(new DateTime());
$model->orderId = 1;
$model->shippingCost = 0.00;
$model->orderReference = 'EXT-ID-123';
$model->deliverAtNeighbour = true;
$model->customerId = 1;
$model->shippingAgent = \Afosto\FashionPartner\Helpers\ShippingMethodHelper::METHOD_POST_NL;

$model->shipmentAddress = $address;
$model->customer = $contact;
$model->items[] = $item;

if (!$model->push()) {
    print_r($model->errors);
}