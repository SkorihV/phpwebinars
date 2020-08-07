<?php

use App\Request;
use App\TasksQueue;
use App\Response;

$id = Request::getIntFromGet('id');


TasksQueue::runById($id);
Response::redirect('/queue/list');