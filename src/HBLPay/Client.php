<?php


namespace HBLPay;


use HBLPay\Common\Constant;
use HBLPay\Http\RestClient;
use HBLPay\Model\AuthenticationFields;
use HBLPay\Model\CheckoutReq;
use Exception;

/**
 * Class Client
 *
 * @package HBLPay
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class Client
{
    private $ENV;
    private $AuthenticationFields;
    private $baseUrl;
    private $rsa;
    private $restClient;

    /**
     * Client constructor.
     *
     * @param array $configs
     * @throws Exception
     */
    public function __construct($configs = [])
    {
        if (!isset($configs["env"]) || empty($configs["env"])) {
            throw new Exception("API environment value is required.");
        }

        if (!isset($configs["authentication"]) || empty($configs["authentication"])) {
            throw new Exception("Authentication fields are required.");
        }

        $this->ENV = $configs["env"];
        $this->baseUrl = ($this->ENV === Constant::ENV_SANDBOX) ? Constant::BASE_URL_SANDBOX : Constant::BASE_URL_PRODUCTION;

        // RSA for encryption/decryption of payload.
        $this->rsa = new RSA();
        $this->restClient = new RestClient();
        $this->AuthenticationFields = new AuthenticationFields($configs["authentication"]);
    }



    /**
     * Get session id.
     *
     * @param CheckoutReq $checkoutReq
     * @return mixed
     * @throws \Exception
     */
    public function getSessionId(CheckoutReq $checkoutReq)
    {
        $uriToken = ($this->ENV === Constant::ENV_SANDBOX) ? "HBLPay" : "HostedCheckout";
        $url = $this->baseUrl . $uriToken . "/api/checkout";

        $checkoutReq->USER_ID = $this->AuthenticationFields->USER_ID;
        $checkoutReq->PASSWORD = $this->AuthenticationFields->PASSWORD;
        $checkoutReq->RETURN_URL = $this->AuthenticationFields->RETURN_URL;
        $checkoutReq->CANCEL_URL = $this->AuthenticationFields->CANCEL_URL;
        $checkoutReq->CHANNEL = $this->AuthenticationFields->CHANNEL;
        $checkoutReq->TYPE_ID = $this->AuthenticationFields->TYPE_ID;

        $postFields = $this->rsa->encryptPayload($checkoutReq);

        try
        {
            $response = $this->restClient->postJson($url, $postFields);

            if (isset($response->Data->SESSION_ID))
            {
                return $response->Data->SESSION_ID;
            }
            else {
                throw new \Exception(json_encode([
                    "url" => $url,
                    "response" => $response
                ]));
            }
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Redirect to HBL portal for payment.
     *
     * @param $sessionId
     */
    public function redirectToPortal($sessionId)
    {
        $uriToken = ($this->ENV === Constant::ENV_SANDBOX) ? "HBLPay" : "HostedCheckout";
        $fullUrl = $this->baseUrl . $uriToken . "/Site/index.html#/checkout";

        $sessionId = base64_encode($sessionId);

        header("Location: {$fullUrl}?data={$sessionId}");
    }

    /**
     * Get session id and redirect to HBL portal for payment in one single request.
     *
     * @param CheckoutReq $checkoutReq
     * @throws \Exception
     */
    public function getSessionAndRedirectToPortal(CheckoutReq $checkoutReq)
    {
        try
        {
            $sessionId = $this->getSessionId($checkoutReq);
            $this->redirectToPortal($sessionId);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}