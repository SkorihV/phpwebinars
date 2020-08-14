<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 15:29
 */

namespace App\Queue;

use App\Renderer;
use App\Request;
use App\Response;
use App\TasksQueue;

class QueueController
{
    
    public function list(){
        $tasks = TasksQueue::getTaskList();


        Renderer::getSmarty()->assign('tasks', $tasks);
        Renderer::getSmarty()->display('queue/list.tpl');
    }
    public function run(){
        $id = Request::getIntFromGet('id');

        TasksQueue::runById($id);
        Response::redirect('/queue/list');
    }

}