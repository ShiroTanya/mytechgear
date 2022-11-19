<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Language 
{
	

	public function handle($request, Closure $next)
	{
		if(session()->has('locate'))
		{
			App::setlocale(session()->get('locate'));
		}
		return $next($request);
	}
} 