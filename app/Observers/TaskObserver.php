<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\Activity;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->recordActivity('task_created');
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {        
        $description = $task->is_completed() ? 'task_completed' : 'task_incompleted';

        if ($task->isClean('completed')) {
            // if there no update in completed attribute, change the activity
            $description = 'task_updated';
        }

        $task->recordActivity($description);
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {        
        $description = 'task_deleted';

        $task->recordActivity($description);
    }
}
