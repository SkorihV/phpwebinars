<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.08.20
 * Time: 14:51
 */

namespace App\Router;


use App\Http\Request;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;

class Route
{
    private $url;

    /**
     * @var string|null
     */
    private $controller = null;

    /**
     * @var string|null
     */
    private $method = null;

    /**
     * @var array
     */
    private $param = [];


    public function __construct(Request $request)
    {
        $this->url = $request->getUrl();
    }

    /**
     * @return string|null
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(?string $url): Route
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getController(): ?string
    {
        return $this->controller;
    }

    /**
     * @param $controller|null
     * @return Route
     */
    public function setController($controller): Route
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return Route
     */
    public function setMethod($method): Route
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     * @throws MethodDoesNotExistException
     * @throws NotFoundException
     */
    public function execute() {
//        $controller = new ($this->getController())($controllerParams);
        $controllerClass = $this->getController();

        if (is_null($controllerClass)) {
            throw new NotFoundException();
        }

        $controller = new $controllerClass($this);

        $controllerMethod = $this->getMethod();

        if (method_exists($controller, $controllerMethod)) {
            return $controller->{$controllerMethod}();
        }
        
        throw new MethodDoesNotExistException();
    }

    public function setParam(string $key, $value) {
        $this->param[$key] = $value;

        return $this;
    }

    public function getParam(string $key) {
        return $this->param[$key] ?? null;
    }

    public function clearParams() {
        $this->param = [];

        return $this;
    }



}