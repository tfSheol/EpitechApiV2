<?php
/**
 * Planning.class.php made by Sheol
 * 18/03/2015 - 15:18
 */

namespace api\EpitechV2\classes;

class Planning extends Get {
    private $_minInfos = array();
    private $_labo = array();

    public function setData($token, $dateStart, $dateEnd) {
        $this->set($this->get(array("token" => $token,
                                    "start" => $dateStart,
                                    "end" => $dateEnd)));
    }

    private function initTab(&$tab, $i, $item) {
        $tab[$i]['title'] = $item['title'];
        $tab[$i]['start'] = $item['start'];
        $tab[$i]['end'] = $item['end'];
        $tab[$i]['duration'] = $item['duration'];
        $tab[$i]['calendar_type'] = $item['calendar_type'];
        $tab[$i]['registered'] = $item['registered'];
        $tab[$i]['nb_place'] = $item['nb_place'];
        $tab[$i]['location'] = $item['location'];
        $tab[$i]['confirm_maker'] = $item['confirm_maker'];
        $tab[$i]['confirm_owner'] = $item['confirm_owner'];
        $tab[$i]['event_registered'] = $item['event_registered'];
    }

    public function setCustom() {
        $i = -1;
        foreach ($this->getData() as $item) {
            if (isset($item['calendar_type'])) {
                $this->initTab($this->_minInfos, ++$i, $item);
            }
        }
    }

    /**
     * "labo", "perso", "asso"
     *
     * @param $type
     */
    public function setOnlyType($type) {
        $i = -1;
        foreach ($this->getData() as $item) {
            if (isset($item['calendar_type']) &&
                (($item['calendar_type'] == $type) &&
                ($item['confirm_maker'] == 1) &&
                ($item['confirm_owner'] == 1))) {
                $this->initTab($this->_labo, ++$i, $item);
            }
        }
    }

    public function getCustom() {
        return $this->_minInfos;
    }

    public function getOnlyType() {
        return $this->_labo;
    }
}
