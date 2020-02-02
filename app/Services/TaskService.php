<?php
namespace App\Services;

use BadMethodCallException;
use InvalidArgumentException;

class TaskService{
    /**
     * A task repository instance
     *
     * @var \App\Repositories\TaskRepository;
     */
    protected $taskRepo;

    function __construct(\App\Repositories\TaskRepository $taskRepository)
    {
        $this->taskRepo = $taskRepository;
    }
    public function updateStatus($task, $isDone)
    {
        $status = filter_var($isDone, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if(is_null($status)){
            throw new InvalidArgumentException("Status provided is not a boolean");
        }
        $updateTask = $this->taskRepo->update($task, ['isDone' => $status]);
        return $updateTask;
    }

    public function createTask($data)
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function updateTask($task, $data)
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getTaskForUser($user, $options)
    {
        # code...
    }
}