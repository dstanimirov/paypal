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
            "client_id": "",
            "client_secret": "-"
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


*  Creating Order and redirect user to PayPal 

see example-create-order-request.php