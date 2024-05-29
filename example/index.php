<?php

require_once "../vendor/autoload.php";

use HBLPay\Client;
use HBLPay\Common\Constant;
use HBLPay\Model\AdditionalData;
use HBLPay\Model\AuthenticationFields;
use HBLPay\Model\CheckoutReq;
use HBLPay\Model\Item;
use HBLPay\Model\Order;
use HBLPay\Model\ShippingDetail;

try
{
    // Request construction. Given the minimum required data.
    $checkoutReq = new CheckoutReq([
        "ORDER" => new Order([
            "DISCOUNT_ON_TOTAL" => 0, // Required - (In doc mentioned Optional)
            "SUBTOTAL" => 100, // Required
            "OrderSummaryDescription" => [
                new Item([
                    "ITEM_NAME" => "OOP PHP",
                    "CATEGORY" => "IT",
                    "SUB_CATEGORY" => "Programing",
                    "UNIT_PRICE" => 100,
                    "QUANTITY" => 1
                ])
            ] // Required
        ]),
        "SHIPPING_DETAIL" => new ShippingDetail([
            "NAME" => "NULL", // Required
        ]),
        "ADDITIONAL_DATA" => new AdditionalData([
            "REFERENCE_NUMBER" => sprintf("INVOICE%s", time()), // Required
            "CUSTOMER_ID" => "1", // Required - (Does not mentioned in document)
            "CURRENCY" => "PKR", // Required
            "BILL_TO_FORENAME" => "Masood", // Required
            "BILL_TO_SURNAME" => "Rehman", // Required
            "BILL_TO_EMAIL" => "masoodurrehman42@gmail.com", // Required
            "BILL_TO_PHONE" => "+923339227639", // Required
            "BILL_TO_ADDRESS_LINE" => "Street 11", // Required
            "BILL_TO_ADDRESS_CITY" => "Peshawar", // Required
            "BILL_TO_ADDRESS_STATE" => "KPK", // Required
            "BILL_TO_ADDRESS_COUNTRY" => "PK", // Required
            "BILL_TO_ADDRESS_POSTAL_CODE" => "25100", // Required
        ])
    ]);

    // Client initialization.
    $hblPay = new Client([
        "env" => Constant::ENV_SANDBOX,
        "authentication" => new AuthenticationFields([
            "USER_ID" => "xxxxxx",
            "PASSWORD" => "xxxxxx",
            "CHANNEL" => "xxxxxx",
            "RETURN_URL" => "http://localhost:8000/example/success.php",
            "CANCEL_URL" => "http://localhost:8000/example/fail.php"
        ]),
        "rsa" => [
            "publicKeyPath" => "<hbl-public-key-file-path>",
            "privateKeyPath" => "<your-private-key-file-path>",
        ]
    ]);

    // This method will get session from hbl and redirect to hbl portal for payment.
    $hblPay->getSessionAndRedirectToPortal($checkoutReq);
}
catch (Exception $e)
{
    echo $e->getMessage();
}