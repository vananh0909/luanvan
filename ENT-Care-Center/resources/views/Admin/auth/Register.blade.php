@extends('Admin.Clients.ClientAd')
@section('title')
    {{ $title }}
@endsection
@section('content')
    @if (session('status'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Đăng Ký Thành Công ✅",
                    text: "{{ session('status') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @elseif (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Đăng Ký Thất Bại ❌",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form method="POST" action="{{ route('postauth') }}"
            style="border-radius:6px; border: 1px solid #ccc; height: 410px; width: 500px">
            @CSRF

            <div style="margin-top: 35px">
                <h1 style="font-size:16px; text-align:center">ĐĂNG KÝ TÀI KHOẢN AUTH <i class="fas fa-user"></i></h1>
            </div>

            <div style="margin-left: 40px; margin-top: 60px;">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="AD_Name" class="col-form-label">Họ Tên: </label>
                    </div>
                    <div class="col-7">
                        <input type="text" id="AD_Name" class="form-control" aria-describedby="nameHelpInline"
                            name="AD_Name" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="AD_Phone" class="col-form-label">Điện Thoại: </label>
                    </div>
                    <div class="col-7">
                        <input type="text" id="AD_Phone" class="form-control" aria-describedby="phoneHelpInline"
                            name="AD_Phone" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="AD_Email" class="col-form-label">Email:</label>
                    </div>
                    <div class="col-7">
                        <input type="email" class="form-control" id="AD_Email" aria-describedby="emailHelpInline"
                            name="AD_Email" required>
                    </div>
                </div>

                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="AD_Password" class="col-form-label">Password</label>
                    </div>
                    <div class="col-7">
                        <input type="password" id="AD_Password" class="form-control" aria-describedby="passwordHelpInline"
                            name="AD_Password" required>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-8">
                        <button type="submit" style="margin-left: 26px" class="btn btn-light">Đăng Ký</button>
                    </div>
                    <div>
                        <p style="font-size:13px; margin-left:-10px; margin-top: 10px"> Bạn đã có tài khoản?

                            <a class="hover" href="{{ route('auth') }}">Đăng ký tài khoản Auth</a> |
                            <a class="hover" href="{{ route('LoginAuth') }}">Đăng nhập tài khoản Auth</a>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('css')
    .hover:hover{
    color:red;
    }
@endsection
