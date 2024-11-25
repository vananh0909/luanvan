<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkbacsi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasAnyRoles(['doctor'])) {
                return $next($request);
            }
        }

        return back()->with('error', 'Bạn chưa có quyền để truy cập trang này !');
    }
}
