<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ModifyRequestParamsMiddleware
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
        $request_params = $request->all();

        foreach ($request_params as $key => $param) {
            if (is_array($param)) {
                continue;
            }
            $request_params[$key] = ucfirst($param);
        }

        $request->replace($request_params);

        return $next($request);
    }
}
