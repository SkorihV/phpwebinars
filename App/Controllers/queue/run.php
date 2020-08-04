<?php

$id = Request::getIntFromGet('id');

TasksQueue::run(id);
Response::redirect('/queue/list');