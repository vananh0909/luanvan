@extends('Clients.Client')

@section('title')
    {{ $title }}
@endsection
@section('content')
    {{-- <h1>Trang home nef</h1> --}}
    <div style=" background: linear-gradient(rgba(127, 168, 209, 0.3) ,rgba(68, 158, 210, 0.8)); height: 728px;
        position: fixed;  top: 0; left: 0; bottom: 0; "
        class="col-md-1">
        @include('layouts.Sidebar')
    </div>
    <div style=" flex: 1;padding-left: 104px;" class="col-md-11">
        <header>
            @include('layouts.Header')
        </header>
        <main>

            <div class="row">
                <div class="col-md-8" style="background-color:rgb(234, 235, 239); margin-left: 6px; margin-top: 10px">
                    <div style="text-align:center; margin-top: 6px; padding-bottom: 8px">
                        <h1 style=" font-size: 24px; "> ĐĂNG NHẬP</h1>

                    </div>


                    <div style="background-color: rgb(234, 235, 239); width: 480px; height:520px; border-radius:6px; margin:0 auto; border: 1px solid rgb(154, 153, 153);"
                        class="col-md-6">

                        <div style="text-align: center">
                            <img style="width: 200px" src="{{ asset('images/img-nen/logo.png') }}">
                        </div>
                        <form method="POST" action="{{ route('User.postdangnhap') }}">
                            @csrf
                            <div style="margin: 20px 40px 10px 40px">
                                <label for="sodienthoai" class="form-label">Số Điện Thoại (<span
                                        style="color:red">*</span>)</label>

                                <input id="sdt" class="form-control" name="CUS_Phone" required>

                            </div>

                            <div style="margin-left: 40px; margin-right: 40px">
                                <label for="inputPassword5" class="form-label">Mật Khẩu (<span
                                        style="color:red">*</span>)</label>
                                <div class="input-group">
                                    <input type="password" id="inputPassword5" class="form-control"
                                        aria-describedby="passwordHelpBlock" name="CUS_PASS" required>
                                    <button type="button" id="togglePassword" class="btn btn-light"><i id="eyeIcon"
                                            class="fa-regular fa-eye"></i></button>

                                    <script>
                                        document.getElementById('togglePassword').addEventListener('click', function() {
                                            var passwordInput = document.getElementById('inputPassword5');
                                            var eyeIcon = document.getElementById('eyeIcon');

                                            if (passwordInput.type === "password") {
                                                passwordInput.type = "text";
                                                eyeIcon.className = "fa-solid fa-eye-slash";
                                            } else {
                                                passwordInput.type = "password";
                                                eyeIcon.className = "fa-regular fa-eye";
                                            }
                                        });
                                    </script>

                                </div>
                            </div>


                            <div style="text-align: center; margin-top: 34px">
                                <button type="submit" class="btn btn-info">Đăng Nhập</button>
                            </div>
                        </form>
                        <div style="text-align: center; margin-top: 12px; ">
                            <img class="mxh" style="width: 24px; margin-right:8px"
                                src="https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg">
                            <img class="mxh" style="width: 24px"
                                src="https://i.pinimg.com/originals/74/65/f3/7465f30319191e2729668875e7a557f2.png">
                        </div>

                        <div style="text-align: center; margin-top: 8px;  ">
                            <p style="font-size: 13px"> Bạn chưa có tài khoản ? <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Đăng ký</a></p>
                            @include('layouts.modal_dangky')
                        </div>

                    </div>


                </div>




                <div class="col-md-3"
                    style="background-color:#ffffff; width:356px; border-radius: 6px;margin-left:16px;margin-bottom:6px;height:642px;">
                    @include('layouts.Right')
                </div>
            </div>


        </main>


    </div>

    @if (session('msg'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Đăng Ký Thành Công ✅",
                text: "Mời bạn đăng nhập để đặt lịch hẹn",
                icon: "success"
            });
        </script>
    @endif


    </div>
@endsection





@section('css')
    {{-- .col-md-1{
    margin-right:34px;
    width:65px;
    }

    .header{
    height:60px;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    }

    .col-md-8{
    width: 1000px;
    margin-right:25px;
    border-radius: 6px;

    }

    footer{
    background-color:green;
    } --}}
@endsection
