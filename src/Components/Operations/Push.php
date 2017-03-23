<?php

namespace Afosto\FashionPartner\Components\Operations;

use Afosto\FashionPartner\Components\App;

trait Push {

    /**
     * @return string
     */
    abstract public function getMethod();

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * @param $result
     *
     * @return bool
     */
    abstract protected function validateResult($result);

    /**
     * Send the model
     *
     * @return bool
     */
    public function push() {
        return $this->validateResult(App::getInstance()->getApi()->call($this->getMethod(), $this->getModel()));
    }

}