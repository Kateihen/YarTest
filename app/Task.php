<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Task extends Model
{
    protected $fillable = [
        'task_name', 'project_id', 'task_body', 'status',
    ];
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
