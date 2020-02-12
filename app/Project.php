<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }
}
