<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'First_name',
        'Last_name',
        'Email',
        'Phone_number',
        'Address',
        'Profile_picture',
        'Joining_date',
        'Account_status',
        'company_id',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}



