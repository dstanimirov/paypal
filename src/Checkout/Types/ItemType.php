<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * ItemType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class ItemType extends BaseType {

    /**
     * @var string
     */
    var $name;

    /**
     * @var string
     */
    var $description;

    /**
     * @var string
     */
    var $sku;

    /**
     * @var array
     */
    var $unit_amount = [];

    /**
     * @var array
     */
    var $tax = [];

    /**
     * @var int
     */
    var $quantity = 0;

    /**
     * @var string
     */
    var $category;

    /**
     * @param string $name
     */
    public function setName($name) {

        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {

        $this->description = $description;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku) {

        $this->sku = $sku;
    }

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setUnitAmount(float $value, string $currency_code) {

        $this->unit_amount = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @param float $value amount
     * @param string $currency_code currency code
     */
    public function setTax(float $value, string $currency_code) {

        $this->tax = [
            'value' => $value,
            'currency_code' => $currency_code
        ];
    }

    /**
     * @param int $quantity Description
     */
    public function setQuantity($quantity) {

        $this->quantity = $quantity;
    }

    /**
     * @param string $category
     */
    public function setCategory($category) {

        $this->category = $category;
    }

    /**
     * @return float Total unit amount (unit_amount)*quantity
     */
    public function calculateItemAmountTotal() {

        $price = !empty($this->unit_amount['value']) ? $this->unit_amount['value'] : 0.00;

        return !empty($this->quantity) ? $price * $this->quantity : $price;
    }
    /**
     * @return float Total unit amount tax (tax)*quantity
     */
    public function calculateItemTaxTotal() {

        $tax = !empty($this->tax['value']) ? $this->tax['value'] : 0.00;

        return !empty($this->quantity) ? $tax * $this->quantity : $tax;
    }

}
