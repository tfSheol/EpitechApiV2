<?php
/**
 * EpitechV2.php made by Sheol
 * 18/03/2015 - 15:13
 */

namespace api\EpitechV2;

class EpitechV2 {
    private $_login;
    private $_config;
    private $_token;
    private $_password;
    private $_planning;

    public function __construct() {
        spl_autoload_register(__NAMESPACE__.'\\EpitechV2::loader');
        $this->_config = new classes\Config();
        $this->_connect = new classes\Connect($this->_config->login);
        $this->_planning = new classes\Planning($this->_config->planning);
    }

    public function loader($class) {
        $tab = explode('\\', $class);
        if (file_exists(__DIR__.'/'.$tab[2].'/'.$tab[3].'.class.php')) {
            require_once (__DIR__.'/'.$tab[2].'/'.$tab[3].'.class.php');
        }
    }

    public function connect($login, $password) {
        $this->_login = $login;
        $this->_password = $password;
        $this->_connect->setData($this->_login, $this->_password);
        if (isset($this->_connect->getData()['token'])) {
            $this->_token = $this->_connect->getData()['token'];
            return false;
        } else {
            echo "ERROR: Fail connect !<br />";
            return true;
        }
    }

    public function getToken() {
        return $this->_token;
    }

    private function &findGoodMethod($class, $method, ...$params) {
        if (isset($params[0])) {
            $params = $params[0];
        }
        foreach (get_class_methods($class) as $data) {
            if ($method === $data) {
                $tmp = $class->$method(@$params[0],
                                       @$params[1],
                                       @$params[2],
                                       @$params[3]);
                return $tmp;
            }
        }
        echo 'ERROR: '.$method.' no found in '.get_class($class).' Class.<br/>';
        return $method;
    }

    public function &getPlanning($method) {
        return $this->findGoodMethod($this->_planning, $method);
    }

    public function setPlanning($method, ...$params) {
        return $this->findGoodMethod($this->_planning, $method, $params);
    }
}
