# PayPal Phalcon plugin 

**How to use**

*  Create Config file with PayPal credentials

```
{
    "sandbox": 1,
    "brand_name": "Custom Brand Name",
    "production": {
        "credentials": {
            "client_id": "client_id_production",
            "client_secret": "client_secret_production"
        },
        "debug": {
            "enabled": 0,
            "cache": 0,
            "logLevel": "INFO"
        },
        "webhook": {
            "PAYMENT": "",
            "BILLING": ""
        },
        "return_url": "",
        "cancel_url": ""
    },
    "development": {
        "credentials": {
            "client_id": "client_id_sandbox",
            "client_secret": "client_secret_sandbox"
        },
        "debug": {
            "enabled": 1,
            "cache": 1,
            "logLevel": "DEBUG"
        },
        "webhook": {
            "PAYMENT": "",
            "BILLING": ""
        },
        "return_url": "",
        "cancel_url": ""
    }
}
``````


*  Creating Order and redirect user to PayPal (approve url)

```
example-create-order-request.php
```


*  Example response from PayPal after Create Order Request

```
{
    "id": "49T7352936398222R",
    "intent": "CAPTURE",
    "purchase_units": {
        "0": {
            "reference_id": "AA243DRF343",
            "amount": {
                "currency_code": "GBP",
                "value": "8.80"
            },
            "payee": {
                "email_address": "stanimirov.dimitar-facilitator@gmail.com",
                "merchant_id": "SS728YLJSZBBC"
            },
            "description": "My unit 1"
        },
        "1": {
            "reference_id": "B2223DRF343",
            "amount": {
                "currency_code": "GBP",
                "value": "10.82"
            },
            "payee": {
                "email_address": "stanimirov.dimitar-facilitator@gmail.com",
                "merchant_id": "SS728YLJSZBBC"
            },
            "description": "My unit 2"
        }
    },
    "create_time": "2020-03-06T23:46:54Z",
    "links": {
        "0": {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/49T7352936398222R",
            "rel": "self",
            "method": "GET"
        },
        "1": {
            "href": "https://www.sandbox.paypal.com/checkoutnow?token=49T7352936398222R",
            "rel": "approve",
            "method": "GET"
        },
        "2": {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/49T7352936398222R",
            "rel": "update",
            "method": "PATCH"
        },
        "3": {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/49T7352936398222R/capture",
            "rel": "capture",
            "method": "POST"
        }
    },
    "status": "CREATED"
}
``````

*  Get order ID and approve url

``````
/* @var $result \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CreateOrderResponseType */
$result = $order->getOrderCreateResult();

//Get order ID , format 8V127094EB6341009
$order_id = $result->id;

//redirect user to accept the payment
$redirect_url = $result->links->getApproveUrl();
``````


*  Accept Order as send to PayPal the OrdersCaptureRequest (return_url)

```
example-accept-order-request.php
```