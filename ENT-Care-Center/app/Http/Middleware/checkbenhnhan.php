<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Users;

class checkbenhnhan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra session có chứa thông tin khách hàng hay không
        if (!$request->session()->has('CUS_Id')) {
            // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
            return redirect()->route('User.dangnhap')->with('error', 'Vui lòng đăng nhập vào hệ thống!');
        }
        return $next($request);
    }
}
