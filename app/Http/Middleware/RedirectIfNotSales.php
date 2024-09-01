<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotSales
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('sales')->check()) {
            return redirect('/login-sales');
        }

        return $next($request);
    }

}
