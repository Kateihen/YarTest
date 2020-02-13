<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Task extends Model
{
	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
