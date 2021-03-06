<?php

namespace Afosto\FashionPartner\Helpers;

use Afosto\FashionPartner\Helpers\Exceptions\AppException;
use Afosto\FashionPartner\Models\Orders\CancelHook;
use Afosto\FashionPartner\Models\Orders\CancelOrder;
use Afosto\FashionPartner\Models\Orders\Hook as TraceHook;
use Afosto\FashionPartner\Models\Orders\ReturnHook;
use Afosto\FashionPartner\Models\Orders\ReturnOrder;
use Afosto\FashionPartner\Models\Orders\TrackTrace;
use Afosto\FashionPartner\Models\Stock\Hook as StockHook;
use Afosto\FashionPartner\Models\Stock\StockItem;

class Bucket {

    /**
     * @var array
     */
    private $_payload;

    /**
     * @param null $payload
     *
     * @return StockHook
     */
    public function getStock($payload = null) {
        $this->_validatePayload($payload);
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
     * @param null $payload
     *
     * @return TraceHook
     */
    public function getTrackTrace($payload = null) {
        $this->_validatePayload($payload);
        $hook = new TraceHook();
        $hook->setAttributes($this->_payload);

        $traces = $this->_payload['data']['customerOrderTrackAndTraceList']['customerOrderTrackAndTrace'];

        if (isset($traces['customerOrderNumber'])) {
            //Fix the payload for singular updates
            $reformattedTraces[] = $traces;
            $traces = $reformattedTraces;
        }

        foreach ($traces as $traceData) {
            //Fix the payload for singular style items
            $reformattedStyleList = [];
            if (isset($traceData['styleList']['style'][0])) {
                foreach ($traceData['styleList']['style'] as $styleData) {
                    $reformattedStyleList[] = $styleData;
                }
                $traceData['styleList'] = $reformattedStyleList;
            }

            $trace = new TrackTrace();
            $trace->setAttributes($traceData);
            $hook->list[] = $trace;
        }

        return $hook;
    }

    /**
     * @param null $payload
     *
     * @return ReturnHook
     */
    public function getReturn($payload = null) {
        $this->_validatePayload($payload);

        $hook = new ReturnHook();
        $hook->setAttributes($this->_payload);
        $reformattedReturnList = [];

        if (isset($this->_payload['data']['customerReturnList']['customerReturn'][0])) {
            foreach ($this->_payload['data']['customerReturnList']['customerReturn'] as $returnData) {
                $reformattedReturnList[] = $returnData;
            }
            $this->_payload['data']['customerReturnList'] = $reformattedReturnList;
        }

        foreach ($this->_payload['data']['customerReturnList'] as $returnData) {
            $returnOrder = new ReturnOrder();
            if (isset($returnData['styleList']['style'][0])) {
                $reformattedStyleList = [];
                foreach ($returnData['styleList']['style'] as $style) {
                    $reformattedStyleList[] = $style;
                }
                $returnData['styleList'] = $reformattedStyleList;
            }
            $returnOrder->setAttributes($returnData);
            $hook->list[] = $returnOrder;
        }

        return $hook;
    }

    /**
     * @param null $payload
     *
     * @return CancelHook
     */
    public function getCancel($payload = null) {
        $this->_validatePayload($payload);

        $hook = new CancelHook();
        $hook->setAttributes($this->_payload);
        $reformattedCancelList = [];

        if (isset($this->_payload['data']['customerOrderAnnulationList']['customerOrderAnnulation'][0])) {
            foreach ($this->_payload['data']['customerOrderAnnulationList']['customerOrderAnnulation'] as $cancelData) {
                $reformattedCancelList[] = $cancelData;
            }
            $this->_payload['data']['customerOrderAnnulationList'] = $reformattedCancelList;
        }

        foreach ($this->_payload['data']['customerOrderAnnulationList'] as $cancelData) {
            $cancelOrder = new CancelOrder();
            if (isset($cancelData['styleList']['style'][0])) {
                $reformattedStyleList = [];
                foreach ($cancelData['styleList']['style'] as $style) {
                    $reformattedStyleList[] = $style;
                }
                $cancelData['styleList'] = $reformattedStyleList;
            }
            $cancelOrder->setAttributes($cancelData);
            $hook->list[] = $cancelOrder;
        }

        return $hook;
    }

    /**
     * Gather the payload
     *
     * @param null $payload
     *
     * @throws AppException
     */
    private function _validatePayload($payload = null) {
        if ($payload === null) {
            $payload = file_get_contents('php://input');
        }
        if ($this->_isValidXml($payload)) {
            $data = simplexml_load_string($payload);
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
