<?php

namespace App\Http\Middleware;

use Closure;

class CorsTest
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
//        return $next($request)
//            ->header('Access-Control-Allow-Origin', 'http://oschabc.test')
//            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
//            ->header('Access-Control-Allow-Headers', 'Content-Type')
//            ->header('Access-Control-Allow-Origin', 'http://oshcstudents.com.au')
//            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
//            ->header('Access-Control-Allow-Headers', 'Content-Type');

        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin' , '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

        return $response;
    }
}
