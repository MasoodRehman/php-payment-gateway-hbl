<?php

require_once "../vendor/autoload.php";

use HBLPay\Config;
use HBLPay\Helper\CoreHelper;
use HBLPay\RSA;

if (isset($_GET["data"]) && !empty($_GET["data"]))
{
    $data = $_GET["data"];

    $rsa = new RSA();
    $rsp = $rsa->decryptWithPassword($data, Config::CERT_PRIVATE_KEY_PASSWORD);

    CoreHelper::dd($rsp);
}