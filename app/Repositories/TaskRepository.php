<?php

namespace App\Repositories;

class TaskRepository
{

    protected $taskModel;

    function __construct(\App\Task $taskModel)
    {
        $this->taskModel = $taskModel;
    }
    /**
     * Find a task bt the task identifier
     *
     * @param integer $taskId
     * @param array $condition
     *
     * @return null|\App\Task
     */
    public function findById(int $taskId, $condition = [])
    {
        $task =  $this->taskModel->find($taskId);
        return $task;
    }
    public function update($task, $data)
    {
        if(isset($data['isDone']) && $data['isDone']){
            $data['done_at'] = \Carbon\Carbon::now();
        }else{
            $data['done_at'] = null;
        }
        $task->update($data);
        return $task;
    }
}