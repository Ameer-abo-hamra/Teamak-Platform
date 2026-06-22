<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $fillable = ['title' , 'description','task_status','project_id','priority' , 'start_date' , 'end_date' , 'employee_id'];
}
