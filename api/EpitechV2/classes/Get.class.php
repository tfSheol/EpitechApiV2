<?php
/**
 * Get.class.php made by Sheol
 * 18/03/2015 - 16:44
 */

namespace api\EpitechV2\classes;

class Get {
    private $_link;
    private $_data;

    public function __construct($link) {
        $this->setLink($link);
    }

    public function setLink($link) {
        $this->_link = $link;
    }

    public function  getLink() {
        return $this->_link;
    }

    public function get($params) {
        $curl = curl_init($this->_link);
        $tmp_fname = tempnam('/tmp', 'COOKIE');
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_COOKIE, 'language=fr');
        curl_setopt($curl, CURLOPT_COOKIEJAR, $tmp_fname);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $tmp_fname);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        return json_decode(curl_exec($curl), true);
    }

    public function getData() {
        return $this->_data;
    }

    public function set($data) {
        $this->_data = $data;
    }
}
