<?php
namespace App\Repositories;

class TodoRepository {

    public function getTodosForUser($user, $searchCriteria = null){
        $todos = $user->tasks()
                        ->whereDate('due_at', \Carbon\Carbon::now()->format('Y-m-d'))
                        ->orderBy('created_at', 'asc')
                        ->paginate(20);
        return $todos;
    }
}