<?php
/**
 * Connect.class.php made by Sheol
 * 18/03/2015 - 15:15
 */

namespace api\EpitechV2\classes;

class Connect extends Get {
    public function setData($login, $password) {
        $this->set($this->get(array("login" => $login,
                                    "password" => $password)));
    }
}
