<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 18.08.20
 * Time: 12:15
 */

namespace App\DI;

class Container
{
    public function execute(string $className, string $methodName) {
            $controllerClass = $this->getController();

                if (is_null($className)) {
                    throw new NotFoundException();
                }

        $controller = new $className($this);

        $controllerMethod = $this->getMethod();

        if (method_exists($controller, $controllerMethod)) {
            return $controller->{$controllerMethod}();
        }

    }
}