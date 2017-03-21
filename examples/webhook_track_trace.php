<?php

require_once 'vendor/autoload.php';

$bucket = new \Afosto\FashionPartner\Helpers\Bucket();
$hook = $bucket->getTrackTrace();

foreach ($hook->list as $trackTrace) {
    echo $trackTrace->customerOrderNumber . ' ' . $trackTrace->trackAndTraceCode;
}