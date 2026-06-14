<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    protected $fillable = [
        'Company_name',
        'Official_email',
        'Phone_number',
        'Address',
        'Company_logo',
        'Creation_date',
        'password',
        'Status'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
