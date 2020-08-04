<?php


class TasksQueue
{
    public static function addTask(string $name, string $task, array $params) {

        $taskMeta = explode('::', $task);

        $taskClassExist = class_exists($taskMeta[0]);
        $taskMethodExist = method_exists($taskMeta[0], $taskMeta[1]);

        if (!$taskClassExist || !$taskMethodExist) {
            return false;
        }


        return Db::insert('tasks_queue', [
            'name' => $name,
            'task' => $task,
            'params' => json_encode($params),
            'create_at' => Db::expr('NOW()'),
        ]);

    }

    public static function getById(int $taskId){
        $query = "SELECT * FROM tasks_queue WHERE task_id = $taskId";
        return Db::fetchRow($query);
    }

    public static function getTaskList()
    {
        $query = "SELECT * FROM `tasks_queue` ORDER BY create_at DESC";
        return Db::fetchAll($query);

    }

    public static function run(int $id)
    {
        $task = static::getById($id);
    }

}