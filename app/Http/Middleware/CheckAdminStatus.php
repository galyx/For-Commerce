<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminStatus
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
        if (auth()->guard('admin')->check()) {
            // Estatus de ativação do admin
            if (auth()->guard('admin')->user()->status == 0) {
                auth()->logout();
                return redirect('/admin');
            }
        }

        return $next($request);
    }
}
