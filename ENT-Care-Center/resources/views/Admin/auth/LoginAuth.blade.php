@extends('Admin.Clients.ClientAd')

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
        <form method="POST" action="{{ route('postLoginAuth') }}"
            style="border-radius:6px; border: 1px solid #ccc; height: 360px; width: 500px">
            @csrf

            <div style="margin-top: 35px">
                <h1 style="font-size:16px; text-align:center; font-weight:bold">ĐĂNG NHẬP TRANG QUẢN TRỊ <i
                        class="fas fa-user"></i></h1>
            </div>

            <div style="margin-left: 40px; margin-top: 60px;">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="inputEmail" class="col-form-label">Email:</label>
                    </div>
                    <div class="col-7">
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelpInline"
                            name="email" required>
                    </div>
                </div>

                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="inputPassword" class="col-form-label">Password:</label>
                    </div>
                    <div class="col-7">
                        <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpInline"
                            name="password" required>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-8">
                        <button type="submit" style="margin-left: 26px; margin-top: 16px" class="btn btn-light">Đăng
                            Nhập</button>
                    </div>
                    <div>
                        <p style="font-size:13px; margin-top: 40px; margin-left:20px">

                            <a class="hover" href="#">Quên mật khẩu ?</a> |
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
    .hover:hover {
    color: red;
    }
@endsection
