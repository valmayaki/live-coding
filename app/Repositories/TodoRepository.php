<?php
namespace App\Repositories;

class TodoRepository {

    public function getTodosForUser($user, $searchCriteria = []){
        $queryOptions = array_merge([
            'sortBy' => 'created_at',
            'orderBy' => 'asc',
            'perPage' => 20
        ], $searchCriteria);
        $todosQuery = $user->tasks()->whereDate('due_at', \Carbon\Carbon::now()->format('Y-m-d'));
        $todosQuery->orderBy($queryOptions['sortBy'], $queryOptions['orderBy']);
        $todos = $todosQuery->paginate($queryOptions['perPage']);
        return $todos;
    }
}