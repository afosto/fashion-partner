<?php

namespace Afosto\FashionPartner\Models\Users;

use Afosto\FashionPartner\Components\Model;
use Afosto\FashionPartner\Components\Operations\Fetch;

/**
 * Class Login
 * @package Afosto\FashionPartner\Models\User
 *
 * @property string $user
 * @property string $password
 */
class Login extends Model {

    use Fetch;

    /**
     * @return array
     */
    public function getRules() {
        return [
            ['user', 'string', true],
            ['password', 'string', true],
        ];
    }

    /**
     * @return string
     */
    public function getMethod() {
        return 'Logon';
    }

    /**
     * @return mixed
     */
    public function getSessionId() {
        return $this->fetch();
    }

    /**
     * Formats response into string
     *
     * @param $response
     *
     * @return mixed
     */
    public function formatResponse($response) {
        if ($response['return']['status'] == 0) {
            return $response['return']['message'];
        }
    }
}