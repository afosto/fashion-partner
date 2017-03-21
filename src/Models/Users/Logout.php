<?php

namespace Afosto\FashionPartner\Models\Users;

use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Components\App;
use Afosto\FashionPartner\Components\Operations\Fetch;

/**
 * Class Logout
 * @package Afosto\FashionPartner\Models\User
 */
class Logout extends Model {

    use Fetch;

    /**
     * @return array
     */
    public function getRules() {
        return [];
    }

    /**
     * @return array
     */
    public function getModel() {
        return ['sessionId' => App::getInstance()->getApi()->getSessionId()];
    }

    /**
     * @return string
     */
    public function getMethod() {
        return 'Logout';
    }

    /**
     * @return mixed
     */
    public function logout() {
        return $this->fetch();
    }

    /**
     * @param $response
     *
     * @return bool
     */
    protected function formatResponse($response) {
        return true;
    }
}