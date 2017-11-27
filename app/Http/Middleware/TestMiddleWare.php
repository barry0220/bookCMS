<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleWare
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
        $id = session('id');
        if ($id) {
            return $next($request);
        } else {
            // return redirect('/form');
            return "哎哟,不错哟";
        }
    }
}
