<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
	protected $fillable = [
		'project_name', 'creator', 'description',
	];

	public function creator()
	{
		return $this->belongsTo(User::class, 'creator', 'name');
	}
}
