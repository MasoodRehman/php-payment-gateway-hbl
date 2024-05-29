<?php


namespace HBLPay\Model;


use HBLPay\Common\LoadParamsFromArray;

/**
 * Class AuthenticationFields
 *
 * @package HBLPay\Model
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class AuthenticationFields extends LoadParamsFromArray
{
    /**
     * The authentication ID of merchant provided by HBL
     *
     * @var string $USER_ID | Required
     */
    public $USER_ID;

    /**
     * Password provided by HBL to authenticate Merchant profile
     *
     * @var string $PASSWORD | Required
     */
    public $PASSWORD;

    /**
     * Merchant must provide a return URL which will be used to post back after transaction processing
     *
     * @var string $RETURN_URL | Required
     */
    public $RETURN_URL;

    /**
     * Cancel URL will be called from HBL Pay if customer decides to cancel during the transaction
     *
     * @var string $RETURN_URL | Required
     */
    public $CANCEL_URL;

    /**
     * Merchant Channel
     *
     * @var string $CHANNEL | Required
     */
    public $CHANNEL;

    /**
     * Define channel specification (Union Pay, Cybersource)
     *
     * @var string $CHANNEL | Optional
     */
    public $TYPE_ID = 0;
}