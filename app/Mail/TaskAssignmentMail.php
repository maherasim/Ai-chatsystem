<?php

namespace App\Mail;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $developer;
    public Task $task;
    public string $priority;
    public string $teamTitle;

    public function __construct(User $developer, Task $task, string $priority = '', string $teamTitle = '')
    {
        $this->developer = $developer;
        $this->task = $task;
        $this->priority = $priority;
        $this->teamTitle = $teamTitle;
    }

    public function build()
    {
        $subject = 'New Task Assigned: ' . ($this->task->title ?? 'Task');

        return $this->subject($subject)
            ->view('emails.task_assignment')
            ->with([
                'developer' => $this->developer,
                'task' => $this->task,
                'priority' => $this->priority,
                'teamTitle' => $this->teamTitle,
            ]);
    }
}

