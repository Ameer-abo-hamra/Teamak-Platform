<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = ['company_id', 'title', 'description', 'start_date', 'end_date', 'project_status'];


    public function company()
    {
        return $this->BelongsTo(Company::class);

    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
    protected $casts = [
        'project_status' => ProjectStatus::class,
    ];
}
