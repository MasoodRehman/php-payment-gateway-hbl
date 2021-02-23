<?php


namespace HBLPay\Http;


/**
 * Class RestClient
 *
 * @package HBLPay\Http
 */
class RestClient
{
    /**
     * CURL post request.
     *
     * @param $url
     * @param string $payload
     * @return bool|string
     * @throws \Exception
     */
    public function postJson($url, $payload)
    {
        $payload = json_encode($payload);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl))
        {
            $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $errorMessage = curl_error($curl);

            throw new \Exception(sprintf("Error %s: %s", $responseCode, $errorMessage));
        }

        curl_close($curl);

        return json_decode($response);
    }

    /**
     * CURL post request.
     *
     * @param $url
     * @param array $payload
     * @return bool|string
     * @throws \Exception
     */
    protected function post($url, $payload)
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($curl);

        if (curl_errno($curl))
        {
            $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $errorMessage = curl_error($curl);

            throw new \Exception(sprintf("Error %s: %s", $responseCode, $errorMessage));
        }

        curl_close($curl);

        return $response;
    }
}