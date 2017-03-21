<?php

require_once 'vendor/autoload.php';

\Afosto\FashionPartner\Components\App::init($config);

$address = new \Afosto\FashionPartner\Models\Orders\Address();
$address->city = 'Groningen';
$address->country = 'NL';
$address->email = 'peter@afosto.com';
$address->name = 'Peter Bakker';
$address->phone = '0507119520';
$address->street1 = 'Grondzijl 16';
$address->zip_code = '9731DG';

$contact = new \Afosto\FashionPartner\Models\Orders\Contact();
$contact->setAddress($address);
$contact->language = 'NL';

$item = new \Afosto\FashionPartner\Models\Orders\Item();
$item->barcode = '1009200912346';
$item->qty = 1;
$item->price = 15.95;

$model = new \Afosto\FashionPartner\Models\Orders\Order();
$model->setOrderDate(new DateTime());
$model->ord_type = $model::TYPE_ORDER;
$model->ord_num = 1;
$model->cus_code = 1;
$model->del_code = 1;

$model->customer_details = $contact;
$model->delivery_address = $address;

$model->addItem($item);

$model->create();