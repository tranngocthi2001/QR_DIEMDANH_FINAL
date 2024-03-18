<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfUser
{
    public function handle(Request $request, Closure $next)
    {
        // if (Auth::check() && Auth::user()->role === 'user') {
        //     // Nếu người dùng đã đăng nhập và có vai trò là user, chuyển hướng đến trang tạo mã QR
        //     return redirect()->route('/');
        // }

        // Nếu không, tiếp tục truy cập bình thường
        return $next($request);
    }
}
