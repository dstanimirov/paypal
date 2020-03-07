<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Phalcon\Config;
use Phalcon\Text;

/**
 * BaseType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class BaseType {

    public function __construct(Config $params = null) {
        
        $properties = !empty($params) ? $params : [];

        $class = new \ReflectionClass($this);

        $namespace = $class->getNamespaceName();

        foreach ($properties as $property => $value) {

            $clasType = $namespace . '\\' . Text::camelize($property) . 'Type';

            if (gettype($value) === 'object' && $class->hasProperty($property) && class_exists($clasType)) {

                $childClass = new \ReflectionClass($clasType);

                $class->getProperty($property)->setValue($this, $childClass->newInstance($value));

                continue;
            }

            if ($class->hasProperty($property)) {

                $class->getProperty($property)->setValue($this, $value);

                continue;
            }
        }
    }

}
