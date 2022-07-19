<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CkeckPassword
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
        if($request->api_password !=env(key:"API_PASSWORD",default:"OumaimaAbouelhaitam")){
            return response()->json(['message'=>'not find']);

        }
        return $next($request);
    }
}
