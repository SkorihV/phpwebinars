<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 18.08.20
 * Time: 12:15
 */

namespace App\DI;

use ReflectionClass;
use ReflectionMethod;
use ReflectionObject;

class Container
{

    /**
     * @var callable[]
     */
    private $factories = [];

    /**
     * @var object[]
     */
    private $singletones = [];

    public function execute(string $className, string $methodName) {

    }

    public function get(string $className)
    {
        if ($this->isSingletone($className)) {
            return $this->getSingletone($className);
        }
        return $this->createInstance($className);
    }

    public function factory(string $className, callable $factory)
    {
        $this->factories[$className] = $factory;
    }

    public function singletone(string $className, callable $factory = null)
    {
        if(!$this->isSingletone($className)){
            $this->singletones[$className] = null;
        }

        if (is_callable($factory)) {
            $this->factory($className, $factory);
        }
    }

    public function isSingletone(string $className)
    {
        return array_key_exists($className, $this->singletones);
    }

    protected function getSingletone(string $className)
    {
        if (!$this->isSingletone($className)) {
            return null;
        }

        if(is_null($this->singletones[$className])) {
            $this->singletones[$className] = $this->createInstance($className);
        }

        return $this->singletones[$className];
    }

    protected function createInstance(string $className)
    {
        if (isset($this->factories[$className])) {
            return $this->factories[$className]();
        }

        $reflectionClass = new ReflectionClass($className);
        $reflectionConstructor = $reflectionClass->getConstructor();

        if ($reflectionConstructor instanceof ReflectionMethod) {
            $arguments = $this->getDependencies($reflectionConstructor);
            return  $reflectionClass->newInstanceArgs($arguments);
        }
        return $reflectionClass->newInstance();
    }

    /**
     * @param $object
     * @param string $propertyName
     * @param $value
     * @return bool|null
     */
    public function setProperty($object, string $propertyName, $value)
    {
        if(!is_object($object)){
            return null;
        }

        $reflectionController = new ReflectionObject($object);

        $reflectionRenderer = $reflectionController->getProperty($propertyName);
        $reflectionRenderer->setAccessible(true);
        $reflectionRenderer->setValue($object, $value);
        $reflectionRenderer->setAccessible(false);

        return true;
    }

    protected function getDependencies(ReflectionMethod $reflectionMethod)
    {
        $reflectionParameters = $reflectionMethod->getParameters();

        $arguments = [];

        foreach ($reflectionParameters as $parameter) {
            $parameterName = $parameter->getName();
            $parameterType = $parameter->getType();

            assert($parameterType instanceof \ReflectionNamedType);
            $className = $parameterType->getName();

            if (class_exists($className)){
                $arguments[$parameterName] = $this->get($className);
            }

        }

        return $arguments;
    }

    /**
     * @param $object
     * @param string $methodName
     * @return mixed|null
     */
    public function call($object,string $methodName)
    {
        if(!is_object($object)){
            return null;
        }


        $reflectionClass = new ReflectionObject($object);
        $reflectionCMethod = $reflectionClass->getMethod($methodName);
        $arguments = $this->getDependencies($reflectionCMethod);


        return  call_user_func_array([$object, $methodName], $arguments);

    }


}