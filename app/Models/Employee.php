<?php

namespace App\Models;

use App\Enums\AccountStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'profile_picture',
        'joining_date',
        'account_status',
        'title',
        'company_id',
        'job_title',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected $casts = [
        'account_status' => AccountStatus::class,
    ];
}
