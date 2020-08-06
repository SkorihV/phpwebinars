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
            'status' => 'new',
            'params' => json_encode($params),
            'create_at' => Db::expr('NOW()'),
        ]);

    }

    public static function getById(int $taskId){
        $query = "SELECT * FROM tasks_queue WHERE id = $taskId";
        return Db::fetchRow($query);
    }

    public static function getTaskList()
    {
        $query = "SELECT * FROM `tasks_queue` ORDER BY create_at DESC";
        return Db::fetchAll($query);

    }

    public static function setStatus(int $taskId, string $status) {
        $availableStatuses = [
            'new',
            'in_process',
            'done',
        ];

        if(!in_array($status, $availableStatuses)) {
            die("status not valid " . $status . ' for task ' . $taskId);
        }


        return Db::update('tasks_queue', [
                'status' => $status,
            ], 'id = ' . $taskId);

    }
    public static function run(int $id)
    {
        $task = static::getById($id);

        if (empty($task)){
            return false;
        }

        $taskAction = $task['task'];

        $taskAction = explode('::', $taskAction);
        $taskClassExist = class_exists($taskAction[0]);
        $taskMethodExist = method_exists($taskAction[0], $taskAction[1]);


        if (!$taskClassExist || !$taskMethodExist) {
            return false;
        }

        static::setStatus($id, 'in_process');
        $taskParams = json_decode($task['params'], true);
        call_user_func($taskAction, $taskParams);
        static::setStatus($id, 'done');
        return true;

    }

}