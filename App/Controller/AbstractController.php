<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 20.08.20
 * Time: 12:16
 */
namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Renderer\Renderer;
use App\Router\Route;

class AbstractController
{
    /**
     * @var Renderer
     * @onInit(App\Renderer\Renderer)
     */
    protected $renderer;

    /**
     * @var Route
     * @onInit(App\Router\Route)
     */
    protected $route;

    /**
     * @var Response
     * @onInit(App\Http\Response)
     */
    protected $response;

    /**
     * @var Request
     * @onInit(App\Http\Request)
     */
    protected $request;

    /**
     * @param string $template
     * @param array $data
     */
    public function render(string $template, array $data = [])
    {
        $body = $this->renderer->render($template, $data);
        $this->response->setBody($body);

        return $this->response;
    }

    public function redirect(string $url)
    {
        return $this->response->setRedirectUrl($url);
    }
}