<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.09.20
 * Time: 15:05
 */

namespace App;


use App\Config\Config;
use App\Router\Dispatcher;
use App\Router\Exception\ControllerDoesNotExistException;
use App\Router\Exception\ExpectToRecieveResponceObjectException;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;
use Smarty;

class Kernel
{

    /**
     * @var DI\Container
     */
    private $di;


    public function __construct()
    {
        $di = new DI\Container();
        $this->di = $di;

        $di->singletone(Config::class, function () {
            $configDir = 'config';
            return  Config::create($configDir);
        });

        /**
         * @var $config Config
         */
        $config = $di->get(Config::class);

        $di->singletone(Smarty::class, function ($di){
            $smarty = new Smarty();
            $config = $di->get(Config::class);


            $smarty->template_dir = $config->renderer->templateDir;
            $smarty->compile_dir = $config->renderer->compileDir;

            return $smarty;
        });

        foreach ($config->di->singletone as $classname) {
           $di->singletone($classname);
        }

    }

    public function run()
    {
        try {
            $response = (new Dispatcher($this->di))->dispatch();
        } catch (NotFoundException $e) {
            //404
        } catch (ControllerDoesNotExistException | MethodDoesNotExistException $e) {
            //500
        } catch (ExpectToRecieveResponceObjectException $e) {
            //500
        } catch (\ReflectionException $e) {
            //500
        }
    }
}