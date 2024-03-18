<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và là admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng đến trang chủ hoặc trang đăng nhập
        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào khu vực này!');
    }
}

