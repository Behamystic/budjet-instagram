<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Task extends Model
{
    protected $table = 'tasks';  
    protected $fillable = [
        'task_name',
        'priority',  
        'due_date',  
        'status',    
        'description', 
        'image'
    ];
}
