<?php

require_once 'vendor/autoload.php';

\Afosto\FashionPartner\Components\App::init($config);

$model = new \Afosto\FashionPartner\Models\Products\Product();

$model->addVariant('100920032452', 'geel', 'M', 19.95);
$model->style = 'Product naam';
$model->variant = 'Variant 1';
$model->season = '12';
$model->vatPercent = 21;

$picture = new \Afosto\FashionPartner\Models\Products\Picture();
$picture->url = 'http://path.to.image.jpg';
$model->pictures[] = $picture;

$model->create();
