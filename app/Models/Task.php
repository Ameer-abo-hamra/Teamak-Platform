<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'task_status', 'project_id', 'priority', 'start_date', 'end_date', 'employee_id'];

    protected $casts = [
        'priority' => TaskPriority::class ,
        'task_status' =>TaskStatus::class
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
