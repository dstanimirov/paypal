<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Constants;

/**
 * OrderConstants
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class OrderConstants {

    /**
     * @var string
     */
    const INTENT_CAPTURE = 'CAPTURE';

    /**
     * @var string
     */
    const INTENT_AUTHORIZE = 'AUTHORIZE';

    /**
     * @var string
     */
    const LANDING_PAGE_LOGIN = 'LOGIN';

    /**
     * @var string
     */
    const LANDING_PAGE_BILLING = 'BILLING';

    /**
     * @var string
     */
    const LANDING_PAGE_NO_PREFERENCE = 'NO_PREFERENCE';

    /**
     * @var string Use this option when the final amount is not known when the checkout flow is initiated and you want to redirect the customer to the merchant page without processing the payment.
     */
    const USER_ACTION_CONTINUE = 'CONTINUE';

    /**
     * @var string Use this option when the final amount is known when the checkout is initiated and you want to process the payment immediately when the customer clicks Pay Now.
     */
    const USER_ACTION_PAY_NOW = 'PAY_NOW';

    /**
     * @var string The order was created with the specified context.
     */
    const ORDER_STATUS_CREATED = 'CREATED';

    /**
     * @var string The order was saved and persisted. The order status continues to be in progress until a capture is made
     */
    const ORDER_STATUS_SAVED = 'SAVED';

    /**
     * @var string The customer approved the payment through the PayPal wallet
     */
    const ORDER_STATUS_APPROVED = 'APPROVED';

    /**
     * @var string All purchase units in the order are voided.
     */
    const ORDER_STATUS_VOIDED = 'VOIDED';

    /**
     * @var string The payment was authorized or the authorized payment was captured for the order.
     */
    const ORDER_STATUS_COMPLETED = 'COMPLETED';

    /**
     * @var string Danish, Denmark
     */
    const LOCALE_US = 'en-US';

    /**
     * @var string English, United Kingdom
     */
    const LOCALE_GB = 'en-GB';

    /**
     * @var string Danish, Denmark
     */
    const LOCALE_DK = 'da-DK';

    /**
     * @var string Hebrew, Israel
     */
    const LOCALE_IL = 'he-IL';

    /**
     * @var string Indonesian, Indonesia
     */
    const LOCALE_ID = 'id-ID';

    /**
     * @var string Japanese, Japan
     */
    const LOCALE_JP = 'ja-JP';

    /**
     * @var string
     */
    const LOCALE_NO = 'no-NO';

    /**
     * @var string Portuguese, Brazil
     */
    const LOCALE_BR = 'pt-BR';

    /**
     * @var string Russian, Russian Federation
     */
    const LOCALE_RU = 'ru-RU';

    /**
     * @var string Swedish, Sweden
     */
    const LOCALE_SE = 'sv-SE';

    /**
     * @var string Thai, Thailand
     */
    const LOCALE_TH = 'th-TH';

    /**
     * @var string Chinese, China
     */
    const LOCALE_CN = 'zh-CN';

    /**
     * @var string Chinese, Hong Kong
     */
    const LOCALE_HK = 'zh-HK';

    /**
     * @var string Chinese, Taiwan, Province of China
     */
    const LOCALE_TW = 'zh-TW';

}
