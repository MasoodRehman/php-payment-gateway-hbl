# PHP client for the HBL payment gateway.

This client library provides access to the payment gateway web service interface of Habib Bank Limited (HBL) Pakistan.

To use this client, you must first obtain your personal access to the Web Service interface from HBL.

# Requirements

* PHP 5.4 or newer _(tested with 5.4 -> 7.2)_
* CURL, JSON and OpenSSL extensions activated
* A authentication details from HBL

# Installation

The preferred method of installation is via [Composer](https://getcomposer.org/). Run the following command to install the package and add it as a requirement to your project's composer.json:

```
composer require masoodrehman/php-payment-gateway-hbl
```

# Example

To create an HBL client

```php
$hblPay = new Client([
    "env" => Constant::ENV_SANDBOX,
    "authentication" => new AuthenticationFields([
        "USER_ID" => "user-id",
        "PASSWORD" => "password",
        "CHANNEL" => "channel-name",
        "RETURN_URL" => "http://localhost:8001/example/success.php", // replace with your own
        "CANCEL_URL" => "http://localhost:8001/example/fail.php" // replace with your own
    ]),
    "rsa" => [
        "publicKeyPath" => "<hbl-public-key-file-path>",
        "privateKeyPath" => "<your-private-key-file-path>",
    ]
]);
```

A basic example with minimum required parameters in request payload.

```php
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
                        "ITEM_NAME" => "item name",
                        "CATEGORY" => "category name",
                        "SUB_CATEGORY" => "item sub category name",
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
                "CUSTOMER_ID" => "1", // Required - (Did not mention in document)
                "CURRENCY" => "PKR", // Required
                "BILL_TO_FORENAME" => "First name", // Required
                "BILL_TO_SURNAME" => "Last name", // Required
                "BILL_TO_EMAIL" => "youremail@gmail.com", // Required
                "BILL_TO_PHONE" => "+921112222222", // Required
                "BILL_TO_ADDRESS_LINE" => "Street address", // Required
                "BILL_TO_ADDRESS_CITY" => "City", // Required
                "BILL_TO_ADDRESS_STATE" => "State", // Required
                "BILL_TO_ADDRESS_COUNTRY" => "PK", // Required
                "BILL_TO_ADDRESS_POSTAL_CODE" => "00000", // Required
            ])
        ]);
    
        // Call service
        $hblPay->getSessionAndRedirectToPortal($checkoutReq);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
```

## API Summary 

Method                                                  | Description
------------------------------------------------------- | ----------------------------------------------
getSessionId(CheckoutReq $checkoutReq)                  | Get session id from HBL
redirectToPortal(string $sessionId)                     | Take session id as parameter and redirect to HBL portal
getSessionAndRedirectToPortal(CheckoutReq $checkoutReq) | This method do both work in single request, Get session from HBL and redirect to HBL portal for payment.

### Public Key

HBL required RSA 4096-bit key which they use for data encryption in order to secure the
request payload over network layer. Generate your key's and add path during client initialization.

You would need following keys:

- hbl-public.pem (public key shared by HBL)
- pub.pem (Your public key shared with HBL)
- key.pem (Your private key)


### Test Cards:
```
VISA (Non 3D card)
Card #:             4000000000000101
CVV:                111     
Expiry:             12/2020

VISA (3D card)
Card #:             4000000000000002
CVV:                111
Expiry:             12/2020
Test Password:      1234

---------------------------------------

MASTER (Non 3D card)
Card #:             5200000000000114
CVV:                111
Expiry:             12/2020
 
MASTER (3D card)
Card #:             5200000000000007
CVV:                111
Expiry:             12/2020
Test Password:      1234

```


For more detail check the official documentation [here](docs/HBLPay-Integration-Guide-V1.1.pdf).
 
**_Note: The official documentation is not upto date and has some inconsistency._**