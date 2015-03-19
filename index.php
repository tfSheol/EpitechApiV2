<?php
/**
 * index.php made by Sheol
 * 18/03/2015 - 15:18
 */

require_once "./config.php";

$login = "USER";
$password = "PASSWORD";

date_default_timezone_set('Europe/Paris');

$epitechV2 = new \api\EpitechV2\EpitechV2();

if (!$epitechV2->connect($login, $password)) {
    $current_date = time();
    $nex_date = $current_date + 604800;
    $epitechV2->setPlanning("setData", $epitechV2->getToken(),
                            date('Y-m-d H:i:s', $current_date),
                            date('Y-m-d H:i:s', $nex_date));

    $epitechV2->setPlanning("setOnlyType", "labo");

    foreach ($epitechV2->getPlanning("getOnlyType") as $item) {
        echo $item['title']." ".$item['start']." ".$item['duration']."<br />";
    }
}
