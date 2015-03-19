<?php
/**
 * config.php made by Sheol
 * 18/03/2015 - 15:12
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);
function loaderApi($classe) {
    $api = explode('\\', $classe);
    if (file_exists(__DIR__.'/'.$api[0].'/'.$api[1].'/'.$api[1].'.php')) {
        require_once __DIR__.'/'.$api[0].'/'.$api[1].'/'.$api[1].'.php';
    }
}
spl_autoload_register('loaderApi');
