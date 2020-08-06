<?php

$id = Request::getIntFromGet('id');



TasksQueue::runById($id);
Response::redirect('/queue/list');