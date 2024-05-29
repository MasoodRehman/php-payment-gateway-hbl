<?php

require_once "../vendor/autoload.php";

use HBLPay\Helper\CoreHelper;
use HBLPay\RSA;

if (isset($_GET["data"]) && !empty($_GET["data"]))
{
    $data = $_GET["data"];

    $rsa = new RSA();
    $rsp = $rsa->decryptWithPassword($data, 'your-password');

    CoreHelper::dd($rsp);
}