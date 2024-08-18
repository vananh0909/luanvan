<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Kiểm tra người dùng có role là admin không
            if (Auth::user()->hasRole('admin')) {
                return $next($request);
            }
        }

        // Nếu không phải admin, chuyển hướng về trang không có quyền
        return back()->with('error', 'Bạn không có quyền truy cập trang này !');
    }
}
