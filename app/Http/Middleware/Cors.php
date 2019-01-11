<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class Cors
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

        $next = $next($request);
        $next->headers->set('Access-Control-Allow-Origin', '*');
        $next->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $next->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, Authorization, Accept, Accept-Language');
        $next->headers->set('Access-Control-Max-Age', '0');

        return $next;
    }
}