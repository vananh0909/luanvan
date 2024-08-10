@extends('Admin.Clients.ClientAd')

@section('content')
    @if (session('status'))
        <div style="padding-top:60px">
            <h4 style="width: 300px; height:10px; margin: 0 auto;font-size:18px; text-align:center; padding-bottom:40px;"
                class="alert alert-success">
                {{ session('status') }}</h4>
        </div>
    @elseif (session('error'))
        <div style="padding-top:60px">
            <h4 style="width: 500px; height:10px; margin: 0 auto;font-size:18px; text-align:center; padding-bottom:40px;"
                class="alert alert-danger">
                {{ session('error') }}</h4>
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form method="POST" action="{{ route('postLoginAuth') }}"
            style="border-radius:6px; border: 1px solid #ccc; height: 360px; width: 500px">
            @csrf

            <div style="margin-top: 35px">
                <h1 style="font-size:16px; text-align:center">ĐĂNG NHẬP TÀI KHOẢN AUTH <i class="fas fa-user"></i></h1>
            </div>

            <div style="margin-left: 40px; margin-top: 60px;">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="inputEmail" class="col-form-label">Email:</label>
                    </div>
                    <div class="col-7">
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelpInline"
                            name="AD_Email" required>
                    </div>
                </div>

                <div class="row g-3 align-items-center mb-3">
                    <div class="col-3">
                        <label for="inputPassword" class="col-form-label">Password:</label>
                    </div>
                    <div class="col-7">
                        <input id="inputPassword" class="form-control" aria-describedby="passwordHelpInline" type="password"
                            name="AD_Password" required>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-8">
                        <button type="submit" style="margin-left: 26px; margin-top: 16px" class="btn btn-light">Đăng
                            Nhập</button>
                    </div>
                    <div>
                        <p style="font-size:13px; margin-left: -10px; margin-top: 40px"> Bạn đã có tài khoản?

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
