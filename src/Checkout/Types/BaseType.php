<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;


use Phalcon\Text;

/**
 * BaseType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class BaseType {

    /**
     * @param mixed $params \Phalcon\Config or Array
     */
    public function __construct($params = null) {

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

    /**
     * Simply Convert Object to array
     * 
     * @param object $object
     * @return array
     */
    public function toArray($object = false) {

        $class = !empty($object) ? $object : $this;

        $json = json_encode($class, JSON_PRESERVE_ZERO_FRACTION | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

        $array = json_decode($json, true, JSON_PRESERVE_ZERO_FRACTION | JSON_NUMERIC_CHECK);

        return array_filter($array);
    }

    /**
     * Deep Convert class to array
     * 
     * @param object $class
     * @return array
     */
    public function classToArray($class = false) {

        $array = [];

        $object = !empty($class) ? $class : $this;

        foreach ($object as $property => $value) {

            switch (gettype($value)) {
                case 'string':
                    $array[$property] = $value;
                    break;
                case 'object':
                    $array[$property] = $this->toArray($value);
                    break;
                case 'array':
                    $array[$property] = $this->arrayObjectsToArray($value);
                    break;
                default:
                    break;
            }
        }

        return $array;
    }

    /**
     * Deep Convert array with objects to array
     * 
     * @param array $array
     * 
     * @return array
     */
    public function arrayObjectsToArray($array = []) {
        
        array_walk($array, function(&$value) {
            if (is_object($value)) {
                $value = $this->toArray($value);
            }
        });

        return $array;
    }

}
