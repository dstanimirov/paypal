<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * BreakdownType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class BreakdownType extends BaseType {

    /**
     * @var string
     */
    var $item_total;

    /**
     * @var string
     */
    var $shipping;

    /**
     * @var string
     */
    var $handling;

    /**
     * @var string
     */
    var $tax_total;

    /**
     * @var string
     */
    var $shipping_discount;

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setItemTotal(float $value, string $currency_code) {

        $this->item_total = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @return float 
     */
    public function getValueItemTotal() {

        return !empty($this->item_total['value']) ? $this->item_total['value'] : 0.00;
    }

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setShipping(float $value, string $currency_code) {

        $this->shipping = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @return float 
     */
    public function getValueShipping() {

        return !empty($this->shipping['value']) ? $this->shipping['value'] : 0.00;
    }

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setHandling(float $value, string $currency_code) {

        $this->handling = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @return float 
     */
    public function getValueHandling() {

        return !empty($this->handling['value']) ? $this->handling['value'] : 0.00;
    }

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setTaxTotal(float $value, string $currency_code) {

        $this->tax_total = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @return float 
     */
    public function getValueTaxTotal() {

        return !empty($this->tax_total['value']) ? $this->tax_total['value'] : 0.00;
    }

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setShippingDiscount(float $value, string $currency_code) {

        $this->shipping_discount = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @return float 
     */
    public function getValueShippingDiscount() {

        return !empty($this->shipping_discount['value']) ? $this->shipping_discount['value'] : 0.00;
    }

    /**
     * Calculate the total amount from breakdown values
     * 
     * @return float
     */
    public function calculateTotalAmount() {

        $arrayTsum = [
            $this->getValueItemTotal(),
            $this->getValueShipping(),
            $this->getValueHandling(),
            $this->getValueTaxTotal()
        ];

        $total = array_sum($arrayTsum);

        return $total - $this->getValueShippingDiscount();
    }

}
