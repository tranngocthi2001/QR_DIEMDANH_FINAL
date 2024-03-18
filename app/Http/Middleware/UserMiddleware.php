<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
   // Ví dụ về middleware `CheckRole`
public function handle($request, Closure $next)
{
    if (!auth()->user()->hasRole('user')) {
        // Chuyển hướng người dùng nếu họ không có vai trò 'user'
        return redirect('/');
    }

    return $next($request);
}

}
