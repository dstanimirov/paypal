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


*  Creating Order and redirect user to PayPal (example-create-order-request.php)


*  Example response from PayPal after Create Order Request (example-create-order-response.json)

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


*  Accept Order as send to PayPal the OrdersCaptureRequest (example-accept-order-request.php)

*  Example response from PayPal after Orders Capture Request (example-accept-order-response.json)

```
{
    "id": "8V127094EB6341009",
    "intent": "CAPTURE",
    "purchase_units": [
        {
            "reference_id": "B2223DRF343",
            "amount": {
                "currency_code": "GBP",
                "value": "4.80"
            },
            "payee": {
                "email_address": "stanimirov.dimitar-facilitator@gmail.com",
                "merchant_id": "SS728YLJSZBBC"
            },
            "description": "My unit 2",
            "shipping": {
                "name": {
                    "full_name": "stanimirov dimitar buyer"
                },
                "address": {
                    "address_line_1": "1 Main St",
                    "admin_area_2": "San Jose",
                    "admin_area_1": "CA",
                    "postal_code": "95131",
                    "country_code": "US"
                }
            },
            "payments": {
                "captures": [
                    {
                        "id": "86W56220NW5158817",
                        "status": "PENDING",
                        "status_details": {
                            "reason": "RECEIVING_PREFERENCE_MANDATES_MANUAL_ACTION"
                        },
                        "amount": {
                            "currency_code": "GBP",
                            "value": "4.80"
                        },
                        "final_capture": true,
                        "seller_protection": {
                            "status": "ELIGIBLE",
                            "dispute_categories": [
                                "ITEM_NOT_RECEIVED",
                                "UNAUTHORIZED_TRANSACTION"
                            ]
                        },
                        "links": [
                            {
                                "href": "https://api.sandbox.paypal.com/v2/payments/captures/86W56220NW5158817",
                                "rel": "self",
                                "method": "GET"
                            },
                            {
                                "href": "https://api.sandbox.paypal.com/v2/payments/captures/86W56220NW5158817/refund",
                                "rel": "refund",
                                "method": "POST"
                            },
                            {
                                "href": "https://api.sandbox.paypal.com/v2/checkout/orders/8V127094EB6341009",
                                "rel": "up",
                                "method": "GET"
                            }
                        ],
                        "create_time": "2020-03-05T18:41:29Z",
                        "update_time": "2020-03-05T18:41:29Z"
                    }
                ]
            }
        },
        {
            "reference_id": "AA243DRF343",
            "amount": {
                "currency_code": "GBP",
                "value": "2.80"
            },
            "payee": {
                "email_address": "stanimirov.dimitar-facilitator@gmail.com",
                "merchant_id": "SS728YLJSZBBC"
            },
            "description": "My unit 1",
            "shipping": {
                "name": {
                    "full_name": "stanimirov dimitar buyer"
                },
                "address": {
                    "address_line_1": "1 Main St",
                    "admin_area_2": "San Jose",
                    "admin_area_1": "CA",
                    "postal_code": "95131",
                    "country_code": "US"
                }
            },
            "payments": {
                "captures": [
                    {
                        "id": "8RU87954EX614193P",
                        "status": "PENDING",
                        "status_details": {
                            "reason": "RECEIVING_PREFERENCE_MANDATES_MANUAL_ACTION"
                        },
                        "amount": {
                            "currency_code": "GBP",
                            "value": "2.80"
                        },
                        "final_capture": true,
                        "seller_protection": {
                            "status": "ELIGIBLE",
                            "dispute_categories": [
                                "ITEM_NOT_RECEIVED",
                                "UNAUTHORIZED_TRANSACTION"
                            ]
                        },
                        "links": [
                            {
                                "href": "https://api.sandbox.paypal.com/v2/payments/captures/8RU87954EX614193P",
                                "rel": "self",
                                "method": "GET"
                            },
                            {
                                "href": "https://api.sandbox.paypal.com/v2/payments/captures/8RU87954EX614193P/refund",
                                "rel": "refund",
                                "method": "POST"
                            },
                            {
                                "href": "https://api.sandbox.paypal.com/v2/checkout/orders/8V127094EB6341009",
                                "rel": "up",
                                "method": "GET"
                            }
                        ],
                        "create_time": "2020-03-05T18:41:32Z",
                        "update_time": "2020-03-05T18:41:32Z"
                    }
                ]
            }
        }
    ],
    "payer": {
        "name": {
            "given_name": "stanimirov dimitar",
            "surname": "buyer"
        },
        "email_address": "stanimirov.dimitar-buyer@gmail.com",
        "payer_id": "YS94PPRE9CTFJ",
        "address": {
            "country_code": "US"
        }
    },
    "create_time": "2020-03-05T18:41:29Z",
    "update_time": "2020-03-05T18:41:29Z",
    "links": [
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/8V127094EB6341009",
            "rel": "self",
            "method": "GET"
        }
    ],
    "status": "COMPLETED"
}
```