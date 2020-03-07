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
            "client_id": "ATbARdOgav3hGXqWs6mLMchdaGJWGzYJ_oU3VvbT4inI3b6G60y3fFYuQWrfeVO7XaEZsE3hCQgainPU",
            "client_secret": "EJkxpJEqqY7hrleTk_0M1FAXBw89Tl-ldG6NFoh1shDB0aDtHUunylGMfA65U_q2d_7aZq0J09AdaF44"
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