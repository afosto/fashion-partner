<?php

require_once 'vendor/autoload.php';

$bucket = new \Afosto\FashionPartner\Helpers\Bucket();
$hook = $bucket->getStock();

foreach ($hook->list as $stock) {
    echo "New stock for {$stock->barcode} is {$stock->quantity}";
}