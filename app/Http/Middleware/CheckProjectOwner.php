<?php

namespace App\Http\Middleware;

use Closure;
use App\Project;

class CheckProjectOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = request()->route('project_id');
        $project = Project::find($id);

        if ($request->user()->name != $project->creator) {
            return redirect('/projects');
        }
        return $next($request);
    }
}
