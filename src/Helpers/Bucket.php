<?php

namespace Afosto\FashionPartner\Helpers;

use Afosto\FashionPartner\Helpers\Exceptions\AppException;
use Afosto\FashionPartner\Models\Orders\Hook as TraceHook;
use Afosto\FashionPartner\Models\Orders\TrackTrace;
use Afosto\FashionPartner\Models\Stock\Hook as StockHook;
use Afosto\FashionPartner\Models\Stock\StockItem;

class Bucket {

    /**
     * @var array
     */
    private $_payload;

    /**
     * @return StockHook
     */
    public function getStock() {
        $this->_decodePost();
        $hook = new StockHook();
        $hook->setAttributes($this->_payload);

        $stockUpdates = $this->_payload['data']['stockList']['stock'];

        if (isset($this->_payload['data']['stockList']['stock']['barcode'])) {
            //Fix the payload for singular updates
            $reformattedStockUpdates[] = $stockUpdates;
            $stockUpdates = $reformattedStockUpdates;
        }
        foreach ($stockUpdates as $stockData) {
            $stock = new StockItem();
            $stock->setAttributes($stockData);
            $hook->list[] = $stock;
        }

        return $hook;
    }

    /**
     * @return TraceHook
     */
    public function getTrackTrace() {
        $this->_decodePost();
        $hook = new TraceHook();
        $hook->setAttributes($this->_payload);

        $traces = $this->_payload['data']['customerOrderTrackAndTraceList']['customerOrderTrackAndTrace'];

        if (isset($traces['customerOrderNumber'])) {
            //Fix the payload for singular updates
            $reformattedTraces[] = $traces;
            $traces = $reformattedTraces;
        }

        foreach ($traces as $traceData) {
            $trace = new TrackTrace();
            $trace->setAttributes($traceData);
            $hook->list[] = $trace;
        }

        return $hook;
    }

    /**
     * Gather the payload
     */
    private function _decodePost() {
        $content = file_get_contents('php://input');
        if ($this->_isValidXml($content)) {
            $data = simplexml_load_string($content);
            $this->_payload = json_decode(json_encode($data), true);
        } else {
            throw new AppException('Incomming request is not valid');
        }
    }

    /**
     * @param $content
     *
     * @return bool
     */
    private function _isValidXml($content) {
        $content = trim($content);
        if (empty($content)) {
            return false;
        }

        libxml_use_internal_errors(true);
        simplexml_load_string($content);
        $errors = libxml_get_errors();
        libxml_clear_errors();

        return empty($errors);
    }

}