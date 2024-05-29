<?php


namespace HBLPay;


/**
 * Class RSA
 *
 * RSA (Rivest–Shamir–Adleman) is an algorithm used by modern computers to encrypt and decrypt messages.
 * It is an asymmetric cryptographic algorithm. Asymmetric means that there are two different keys.
 * This is also called public key cryptography, because one of the keys can be given to anyone.
 *
 * @package HBLPay
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class RSA
{
    private $publicKeyPath = '';
    private $privateKeyPath = '';

    public static function make()
    {
        return new static;
    }

    /**
     * Set public key path for encryption, this should be the hbl public key.
     *
     * @param $pathOfKey
     * @return RSA
     */
    public function setPublicKeyPath($pathOfKey)
    {
        $this->publicKeyPath = $pathOfKey;
        return $this;
    }

    /**
     * Set private key for decryption, this should be client server private key.
     *
     * @param $pathOfKey
     * @return RSA
     */
    public function setPrivateKeyPath($pathOfKey)
    {
        $this->privateKeyPath = $pathOfKey;
        return $this;
    }

    /**
     * Encrypt string.
     *
     * @param $data
     * @return string
     */
    public function encrypt($data)
    {
        $fp = fopen($this->publicKeyPath,"r");
        $pub_key_string = fread($fp,8192);
        fclose($fp);

        $key_resource = openssl_get_publickey($pub_key_string);
        openssl_public_encrypt($data, $cdata, $key_resource);

        return base64_encode($cdata);
    }

    /**
     * Plus (+) sign giving problem in url query string during decryption, so encode the + sign properly in order
     * to handle properly by php. By default php convert it into space and decryption method will break.
     *
     * @param $string
     * @return string
     */
    private function ConvertPlusSignToEntity($string)
    {
        $string = urlencode($string);
        $string = str_replace("+", "%2B",$string);
        return urldecode($string);
    }

    private function ConvertToList($data)
    {
        parse_str($data, $data_list);

        return $data_list;
    }

    /**
     * Decrypt string.
     *
     * @param $data
     * @return mixed
     */
    public function decrypt($data)
    {
        $fp = fopen($this->privateKeyPath,"r");
        $key_string = fread($fp,8192);
        fclose($fp);

        $data = $this->ConvertPlusSignToEntity($data);

        $key_resource = openssl_get_privatekey($key_string);
        openssl_private_decrypt(base64_decode($data), $decrypted_data, $key_resource);

        return $this->ConvertToList($decrypted_data);
    }

    /**
     * Decrypt string.
     *
     * @param $data
     * @param string $password
     * @return mixed
     */
    public function decryptWithPassword($data, $password)
    {
        $fp = fopen($this->privateKeyPath,"r");
        $key_string = fread($fp,8192);
        fclose($fp);

        $data = $this->ConvertPlusSignToEntity($data);

        $key_resource = openssl_get_privatekey($key_string, $password);
        openssl_private_decrypt(base64_decode($data), $decrypted_data, $key_resource);

        return $this->ConvertToList($decrypted_data);
    }

    /**
     * Encrypt payload.
     *
     * @param $payload
     * @return mixed
     */
    public function encryptPayload(&$payload)
    {
        foreach ($payload as $key => $val)
        {
            if (is_array($val)) {
                $this->encryptPayload($val);
                continue;
            }

            if (is_object($val)) {
                $this->encryptPayload($val);
                continue;
            }

            if (!is_null($val) && $key !== "USER_ID") { // USER_ID should not be encrypted.
                $payload->{$key} = $this->encrypt($val);
            }
        }

        return $payload;
    }
}