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
use App\TasksQueue;

class QueueController extends AbstractController
{
    
    public function list(){
        $tasks = TasksQueue::getTaskList();


        Renderer::getSmarty()->assign('tasks', $tasks);
        Renderer::getSmarty()->display('queue/list.tpl');
    }
    public function run(){
        $id = Request::getIntFromGet('id');

        TasksQueue::runById($id);
        $this->redirect('/queue/list');
    }

}