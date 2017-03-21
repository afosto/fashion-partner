<?php

namespace Afosto\FashionPartner\Components\Operations;

use Afosto\FashionPartner\Components\App;

trait Fetch {

    /**
     * @return string
     */
    abstract public function getMethod();

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * @return mixed
     */
    abstract protected function formatResponse();

    /**
     * @return mixed
     */
    public function fetch() {
        return $this->formatResponse(App::getInstance()->getApi()->call($this->getMethod(), $this->getModel()));
    }

}