<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\LinkType;

/**
 * LinksType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class LinksType {

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\LinkType
     */
    var $link = [];

    public function __construct(\Phalcon\Config $unit) {

        foreach ($unit as $value) {

            $this->link[] = new LinkType($value);
        }
    }

    /**
     * @return int Number of links
     */
    public function count() {
        return count($this->link);
    }

    /**
     * @return string PayPal approve URL
     * @return false if no approve link into result
     */
    public function getApproveUrl() {

        $approve_url = false;

        foreach ($this->link as $link) {

            if ($link->rel === 'approve') {

                $approve_url = $link->href;

                break;
            }
        }

        return $approve_url;
    }

}
