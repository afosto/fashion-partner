<?php

namespace Afosto\FashionPartner\Components;

use Afosto\FashionPartner\Helpers\Exceptions\ApiException;
use Afosto\FashionPartner\Helpers\Exceptions\AppException;
use Afosto\FashionPartner\Models\Users\Login;
use Afosto\FashionPartner\Models\Users\Logout;

class Api {

    /**
     * Seconds to wait before we expect an answer
     */
    const CONNECTION_TIMEOUT = 5;

    /**
     * Used to identify the company / account
     * @var string
     */
    private $_companyCode;

    /**
     * The session id, obtained after connecting
     * @var string
     */
    private $_sessionId;

    /**
     * @var \SoapClient
     */
    private $_client;

    /**
     * @var string
     */
    private $_password;

    /**
     * @var string
     */
    private $_user;

    /**
     * True when in debug mode
     *
     * @var boolean
     */
    private $_debug;

    /**
     * Initialize the api connection
     *
     * @param $config
     */
    public function init($config) {
        $this->_user = $config['user'];
        $this->_password = $config['password'];
        $this->_companyCode = $config['companyCode'];
        $this->_debug = isset($config['debug']) ? $config['debug'] : false;
        $this->_client = new \SoapClient($config['wsdl'], [
            'connection_timeout' => self::CONNECTION_TIMEOUT,
            'user_agent'         => 'Afosto DNL Client',
            'trace'              => $this->_debug,
            'stream_context'     => stream_context_create([
                'http' => [
                    'accept' => 'application/xml',
                ],
            ]),
        ]);
    }

    /**
     * Always logout
     */
    public function __destruct() {
        $logout = new Logout();
        $logout->logout();
    }

    /**
     * @param       $method
     * @param array $params
     *
     * @return mixed
     */
    public function call($method, array $params = []) {
        $method = ucfirst($method);
        $response = $this->_client->{$method}($params);

        return json_decode(json_encode($response), true);
    }

    /**
     * @return string
     * @throws AppException
     */
    public function getSessionId() {
        if ($this->_sessionId === null) {

            //Login to obtain a session id
            $login = new Login();
            $login->user = $this->_user;
            $login->password = $this->_password;
            $this->_sessionId = $login->getSessionId();
        }

        return $this->_sessionId;
    }

    /**
     * Returns the last request as string
     *
     * @return string
     */
    public function showLastRequest() {
        if ($this->_debug === true) {
            header("Content-type: application/xml");
            echo trim(preg_replace('/\s\s+/', ' ', $this->_client->__getLastRequest()));
            exit();
        }
    }

    /**
     * @return string
     */
    public function getCompanyCode() {
        return $this->_companyCode;
    }

}