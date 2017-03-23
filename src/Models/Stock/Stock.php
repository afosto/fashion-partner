<?php

namespace Afosto\FashionPartner\Models\Stock;

use Afosto\FashionPartner\Components\App;
use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Components\Operations\Fetch;

/**
 * Class Find
 * @package Afosto\FashionPartner\Models\Stock
 *
 * @property boolean $allStock
 * @property string  $barcode
 */
class Stock extends Model {

    use Fetch;

    public function getMethod() {
        return 'GetStock';
    }

    public function getRules() {
        return [
            ['allStock', 'boolean', false],
            ['barcode', 'string', false, 13],
        ];
    }

    public function getModel() {
        return array_merge([
            'sessionId'   => App::getInstance()->getApi()->getSessionId(),
            'companyCode' => App::getInstance()->getApi()->getCompanyCode(),
        ], parent::getModel());
    }

    /**
     * Helper to get all stock
     *
     * @return StockItem[]
     */
    public function findAll() {
        $this->allStock = 'y';

        return $this->fetch();
    }

    /**
     * @return StockItem[]
     */
    protected function formatResponse($response) {
        $stockList = [];
        foreach ($response['return']['STOCK_LIST']['STOCK'] AS $stockData) {
            $stock = new StockItem();
            $stock->barcode = $stockData['BARCODE'];
            $stock->quantity = $stockData['QTY'];
            $stockList[] = $stock;
        }

        return $stockList;
    }
}