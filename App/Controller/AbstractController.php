<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 20.08.20
 * Time: 12:16
 */
namespace App\Controller;

use App\Renderer;
use App\Router\Route;


class AbstractController
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @var Route
     */
    protected $route;

    /**
     * @param string $template
     * @param array $data
     */
    public function render(string $template, array $data = [])
    {
//        $smarty = Renderer::getSmarty();
//
//        foreach ($data as $key => $value) {
//            $smarty->assign($key, $value);
//        }
//
//        return $smarty->display($template);

        $this->renderer->render($template, $data);
    }

    public function redirect(string $url)
    {

    }
}