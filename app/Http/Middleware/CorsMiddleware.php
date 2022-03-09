<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Factory as Auth;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // $headers = [
        //     'Access-Control-Allow-Origin'      => implode(',', [
        //         'http://localhost:8000',
        //         'http://localhost:8080',
        //         'http://localhost:8081',
        //         'http://localhost:8082',
        //         'http://127.0.0.1:8080',
        //     ]),
        //     'Access-Control-Allow-Methods'     => 'POST, GET, PUT, DELETE',
        //     'Access-Control-Allow-Credentials' => 'true',
        //     'Access-Control-Max-Age'           => '86400',
        //     'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        // ];

        // $response = $next($request);
        // foreach($headers as $key => $value)
        // {
        //     $response->header($key, $value);
        // }

        // return $response;
    }
}