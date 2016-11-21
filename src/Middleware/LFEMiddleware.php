<?php

namespace Hzone\LFE\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;

class LFEMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		return $next($request);
	}
}
