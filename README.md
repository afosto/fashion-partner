# FashionPartner API client

Use this client to convieniently interact with FashionPartner's SOAP API developed by DeNederlandse (DNL). This PHP package was developed by Afosto to make a reliable connection between Afosto (Retail Software) and FashionPartner and provides all the basic functionality.

## Getting Started

Simply follow the installation instructions. You will need an account at DNL that is set up for you to use.

### Prerequisites

What things you need to install the software and how to install them
- PHP5.5+
- Composer (for installation)
- PHP SOAP extension

### Installing

Installing is easy through [Composer](http://www.getcomposer.org/). 

```
composer require afosto/fashion-parter
```

Now, to install a webhook (simple example) on your account, use the following code.

Set the configuration
```php
$config = [
    'wsdl'        => '',
    'user'        => '',
    'password'    => '',
    'companyCode' => '',
];
```
Iinit application
```php
App::init($config); 
```
Create a webhook model
```php
$webhook = new Afosto\FashionPartner\Models\Webhooks\Webhook();
$webhook->event = $webhook::HOOK_STOCK;
$webhook->name = 'TestWebhook';
$webhook->address = 'https://myapp.test/bucket.php';
```
Create the webhook
```php
if (!$webhook->push()) {
    print_r($webhook->errors); 
} else {
    echo $webhook->getWebhookId();
}
```

From now on you will receive stock updates at myapp.test/bucket.php. You can even use the integrated webhook bucket to translate the incomming XML into a useable object. Below you see bucket.php:
```php
$bucket = new \Afosto\FashionPartner\Helpers\Bucket();
$hook = $bucket->getStock();

```
Walk through the received updates
```php
foreach ($hook->list as $stock) {
    echo "New stock for {$stock->barcode} is {$stock->quantity}";
}
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/afosto/dnl/tags). 

## License

This project is licensed under the Apache License 2.0 - see the [LICENSE.md](LICENSE.md) file for details
