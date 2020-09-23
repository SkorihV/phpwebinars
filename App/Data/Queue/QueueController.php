<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 15:29
 */

namespace App\Data\Queue;

use App\Controller\AbstractController;
use App\Renderer\Renderer;
use App\Http\Request;
use App\Data\TasksQueue;

class QueueController extends AbstractController
{
    
    public function list(){
        $tasks = TasksQueue::getTaskList();

        $smarty = Renderer::getSmarty();
        $smarty->assign('tasks', $tasks);
        $smarty->display('queue/list.tpl');

//        Renderer::getSmarty()->assign('tasks', $tasks);
//        Renderer::getSmarty()->display('queue/list.tpl');
    }
    public function run(){
        $id = Request::getIntFromGet('id');

        TasksQueue::runById($id);
        return $this->redirect('/queue/list');
    }

}