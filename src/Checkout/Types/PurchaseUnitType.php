<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AmountType;

/**
 * PurchaseUnitType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PurchaseUnitType extends BaseType {

    /**
     * @var string
     */
    var $reference_id;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AmountType
     */
    var $amount;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PayeeType
     */
    var $payee;

    /**
     * @var string
     */
    var $description;

    /**
     * @var string
     */
    var $soft_descriptor;

    /**
     * @var string
     */
    var $custom_id;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ShippingType
     */
    var $shipping;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PaymentsType
     */
    var $payments;

    /**
     * @var array [\Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemsType]
     */
    var $items;

    /**
     * @param string $reference_id
     */
    public function setReferenceId($reference_id) {
        $this->reference_id = $reference_id;
    }

    /**
     * @param string $amount
     */
    public function setAmount(AmountType $amount) {
        $this->amount = $amount;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @param string $custom_id
     */
    public function setCustomId($custom_id) {
        $this->custom_id = $custom_id;
    }

    /**
     * @param string $soft_descriptor
     */
    public function setSoftDescriptor($soft_descriptor) {
        $this->soft_descriptor = $soft_descriptor;
    }

    /**
     * @param \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemsType $item
     */
    public function addItem($item) {

        $this->items[] = $item;
    }

    /**
     * Calculate Items total amount without taxes
     * 
     * @return float
     */
    public function getItemsTotalAmount() {

        $total = 0.00;

        if (empty($this->items)) {

            return $total;
        }

        /* @var $item \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemType */
        foreach ($this->items as $item) {

            $total += $item->calculateItemAmountTotal();
        }

        return $total;
    }

    /**
     * Calculate Items total tax amount
     * 
     * @return float
     */
    public function getItemsTotalTax() {

        $total = 0.00;

        if (empty($this->items)) {

            return $total;
        }

        /* @var $item \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemType */
        foreach ($this->items as $item) {

            $total += $item->calculateItemTaxTotal();
        }

        return $total;
    }
    
    
    public function itemsToArray(){
        
        
        return $this->arrayObjectsToArray($this->items);
        
    }

}
