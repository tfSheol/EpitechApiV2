<?php
/**
 * Config.class.php made by Sheol
 * 18/03/2015 - 16:10
 */

namespace api\EpitechV2\classes;

define("__URLAPI__", "http://epitech-api.herokuapp.com");

class Config {
    public $login;
    public $planning;

    public function __construct() {
        $this->login = __URLAPI__."/login";
        $this->planning = __URLAPI__."/planning";
    }
}
