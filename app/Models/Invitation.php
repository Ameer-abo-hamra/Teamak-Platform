<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'company_id',
        'employee_email',
        'job_title',
        'role',
        'invitation_token',
        'description'

    ];

    public function company () {
        return $this->belongsTo(Company::class);
    }
}
