<?php


namespace HBLPay\Model;


use HBLPay\Common\LoadParamsFromArray;

/**
 * Class AdditionalData
 *
 * @package HBLPay\Model
 * @author <MasoodRehman masoodurrehman42@gmail.com>
 */
class AdditionalData extends LoadParamsFromArray
{
    /**
     * Unique Identifier of specific transaction
     *
     * @var string $ORDER_ID | Optional
     */
    public $ORDER_ID;

    /**
     * Unique Identifier of specific transaction
     *
     * @var string $REFERENCE_NUMBER | Required
     */
    public $REFERENCE_NUMBER;

    /**
     * Total amount of the specific order
     *
     * @var string $AMOUNT | Optional
     */
    public $AMOUNT;

    /**
     * Does not mentioned in official documentation but mentioned in the example.
     *
     * @var string $CUSTOMER_ID | Required
     */
    public $CUSTOMER_ID;

    /**
     * Allowed options of Currency
     *
     * @var string $CURRENCY | Required
     */
    public $CURRENCY;

    /**
     * This field identifies the card and retrieves the associated billing, shipping, and payment information.
     *
     * @var string $PAYMENT_TOKEN | Optional
     */
    public $PAYMENT_TOKEN;

    /**
     * Allowed options of Payment method.
     *
     * @var string $PAYMENT_METHOD | Optional
     */
    public $PAYMENT_METHOD;

    /**
     * Forename of the Biller or the specific customer who placed the order
     *
     * @var string $BILL_TO_FORENAME | Required
     */
    public $BILL_TO_FORENAME;

    /**
     * Surname of the Biller or the specific customer who placed the order
     *
     * @var string $BILL_TO_SURNAME | Required
     */
    public $BILL_TO_SURNAME;

    /**
     * Email address of the biller or the specific customer who placed the order
     *
     * @var string $BILL_TO_EMAIL | Required
     */
    public $BILL_TO_EMAIL;

    /**
     * Contact Number of the Biller or the specific customer who placed the order
     *
     * @var string $BILL_TO_PHONE | Required
     */
    public $BILL_TO_PHONE;

    /**
     * Country of the address that customer put at the time of the transaction
     *
     * @var string $BILL_TO_ADDRESS_LINE | Required
     */
    public $BILL_TO_ADDRESS_LINE;

    /**
     * City of the address that customer put at the time of the transaction
     *
     * @var string $BILL_TO_ADDRESS_CITY | Required
     */
    public $BILL_TO_ADDRESS_CITY;

    /**
     * State of the address that customer put at the time of the transaction
     *
     * @var string $BILL_TO_ADDRESS_STATE | Required
     */
    public $BILL_TO_ADDRESS_STATE;

    /**
     * Country of the address that customer put at the time of the transaction
     *
     * @var string $BILL_TO_ADDRESS_COUNTRY | Required
     */
    public $BILL_TO_ADDRESS_COUNTRY;

    /**
     * Customer put the postal code at the time of the transaction
     *
     * @var string $BILL_TO_ADDRESS_POSTAL_CODE | Required
     */
    public $BILL_TO_ADDRESS_POSTAL_CODE;

    /**
     * Merchant Define Data Fields.
     *
     * @var array<MerchantField> $MerchantFields | Required
     */
    public $MerchantFields;
}