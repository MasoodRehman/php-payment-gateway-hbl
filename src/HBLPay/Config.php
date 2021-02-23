<?php


namespace HBLPay;


/**
 * Class Config
 *
 * @package HBLPay
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class Config
{
    const CERT_PRIVATE_KEY_PASSWORD = "masood";

    public static function getPublicKeyPath()
    {
        return realpath(__DIR__."/Certificates/hbl-public.pem");
    }

    public static function getPrivateKeyPath()
    {
        return realpath(__DIR__."/Certificates/key.pem");
    }
}