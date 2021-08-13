<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanManageBlog {

  public function handle(Request $request, Closure $next) {
    $blog = $request->route('blog');
    $canUserManageBlog = $blog->canUserManageBlog(auth()->user());
    if (!$canUserManageBlog) {
      abort(403);
    }

    return $next($request);
  }

}
