<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use LaravelCommon\Responses\BaseResponse;

class Response
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response =  $next($request);

        if($response instanceof BaseResponse){
            return $response->send();
        }
    }
}
