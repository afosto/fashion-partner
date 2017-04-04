<?php

namespace Afosto\FashionPartner\Components;

use Afosto\FashionPartner\Helpers\Exceptions\AppException;

class App {

    /**
     * The api container
     * @var Api
     */
    private $_api;

    /**
     * @var App
     */
    private static $_app;

    /**
     * Init with the proper configuration
     *
     * @param $config
     */
    public static function init($config) {
        self::$_app = new App($config);
    }

    /**
     * @return App
     * @throws AppException
     */
    public static function getInstance() {
        if (self::$_app === null) {
            throw new AppException('App not initialized');
        }

        return self::$_app;
    }

    /**
     * @return bool
     */
    public static function isReady() {
        return self::$_app !== null;
    }

    /**
     * App constructor.
     *
     * @param array $config
     */
    public function __construct(array $config) {
        $this->_api = new Api();
        $this->_api->init($config);

        return $this;
    }

    /**
     * @return Api
     */
    public function getApi() {
        return $this->_api;
    }

}