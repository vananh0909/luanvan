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
                <div class="col-md-8" style="background-color:rgb(234, 235, 239); margin-left: 6px">

                    <form style="margin: 0 auto">

                        <div style="text-align:center; margin-top: 6px; padding-bottom: 8px">
                            <h1 style=" font-size: 22px; "> CÀI ĐẶT TÀI KHOẢN</h1>

                        </div>


                        <div style=" width: 1000px; height:599px; border-radius:6px; margin:0 auto;  border: 1px solid rgb(154, 153, 153);"
                            class="col-md-6">

                            @if (session('user'))
                                <div style="text-align:center;">
                                    <img class="rounded-circle"
                                        style="width: 130px; height: 130px; margin-top:18px; margin-bottom: 12px"
                                        src="{{ asset('uploads/avtkhachhang/' . session('user')->CUS_Avatar) }} ">

                                    <p style="font-weight:400; font-size: 16px; text-transform: uppercase;">
                                        {{ session('user')->CUS_Name }}
                                    </p>
                                </div>
                                <div style="padding-top: 4px;">
                                    <div style="width: 300px; float: left; margin-left: 160px; text-align:left">
                                        <label for="name" style="margin: 2px">Tên (<span
                                                style="color:red">*</span>)</label>
                                        <input id="name" class="form-control" type="text"
                                            aria-label=".form-control-lg example" name="CUS_Name"
                                            placeholder="{{ session('user')->CUS_Name }}">
                                    </div>
                                    <div style="width: 300px; float: right;text-align:left; margin-right: 160px; ">
                                        <label for="inputPassword5" class="form-label">Mật Khẩu (<span
                                                style="color:red">*</span>)</label>
                                        <div class="input-group" style="margin-top: -4px">
                                            <input type="password" id="inputPassword6" class="form-control"
                                                aria-describedby="passwordHelpBlock" name="CUS_PASS"
                                                placeholder="{{ session('user')->CUS_PASS }}">
                                            <button type="button" id="togglePassword1" class="btn btn-light"><i
                                                    id="eyeIcon" class="fa-regular fa-eye"></i></button>
                                        </div>
                                        <script>
                                            document.getElementById('togglePassword1').addEventListener('click', function() {
                                                var passwordInput = document.getElementById('inputPassword6');
                                                var passwordButton = document.getElementById('togglePassword1');
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

                                    <div style="width: 300px; float: left; margin-left: 160px; text-align:left">
                                        <label for="nganhang" style="margin-top: 4px">Ngày Sinh (<span
                                                style="color:red">*</span>)</label>
                                        <input id="nganhang" class="form-control" type="date"
                                            aria-label=".form-control-lg example" name="CUS_Birthday"
                                            value="{{ session('user')->CUS_Birthday }}">
                                    </div>


                                    <div style="width: 300px; float: right; margin-right: 160px; text-align:left">
                                        <label for="sotaikhoan" style="margin-top: 4px">Ảnh Đại Diện (<span
                                                style="color:red">*</span>)</label>
                                        <input class="form-control" type="file" aria-label=".form-control-lg example"
                                            placeholder="{{ session('user')->CUS_Avatar }}" name="CUS_Avatar">

                                    </div>



                                    <div style="float: left; margin-left: 160px; text-align:left">
                                        <div style="display: inline-block; text-align: left;">
                                            <label
                                                for="gioitinh"style="display: inline-block; vertical-align: top; margin-top: 6px ">Giới
                                                Tính:</label>

                                            <div style="display: inline-block; margin-top: 38px; vertical-align: top;"
                                                class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="CUS_Gender"
                                                    id="inlineRadio1" value="Nam"
                                                    {{ session('user')->CUS_Gender == 'Nam' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">🧒🏻 Nam</label>
                                            </div>

                                            <div style="display: inline-block; margin-top: 38px;vertical-align: top;"
                                                class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="CUS_Gender"
                                                    id="inlineRadio2" value="Nữ"
                                                    {{ session('user')->CUS_Gender == 'Nữ' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">👩🏻 Nữ</label>
                                            </div>

                                        </div>
                                    </div>




                                    <div
                                        style="width:  300px; float: right; margin-right: 160px;text-align:left;margin-top:0.8px">
                                        <label for="sdt" style="margin-top: 4px">Số Điện Thoại (<span
                                                style="color:red">*</span>)</label></label>
                                        <input id="sdt" class="form-control" type="text"
                                            aria-label=".form-control-lg example" name="CUS_Phone"
                                            placeholder="{{ session('user')->CUS_Phone }}">
                                    </div>
                                    <div
                                        style="width: 300px; float: left; margin-left: 160px;text-align:left; margin-top:2.4px">
                                        <label for="email" style="margin-top: 4px">Email: (<span
                                                style="color:red">*</span>)</label></label>
                                        <input id="email" class="form-control" type="email"
                                            aria-label=".form-control-lg example" name="CUS_Email"
                                            placeholder="{{ session('user')->CUS_Email }}">
                                    </div>

                                    <div style="width: 300px; float: right; margin-right: 160px; text-align:left">
                                        <label for="dc" style="margin-top: 4px">Địa Chỉ (<span
                                                style="color:red">*</span>)</label>
                                        <input id="dc" class="form-control" type="text"
                                            aria-label=".form-control-lg example" name="CUS_Address"
                                            placeholder="{{ session('user')->CUS_Address }}">
                                    </div>




                                    <div style="width: 300px; float: left; margin-left: 160px; text-align:left">
                                        <label for="nganhang" style="margin-top: 4px">Ngân Hàng</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="CUS_Nganhang">
                                            <option selected>{{ session('user')->CUS_Nganhang }}"</option>
                                            <option value="Agribank">Agribank</option>
                                            <option value="Sacombank">Sacombank</option>
                                            <option value="MB Bank">MB Bank</option>
                                        </select>
                                        <br>
                                    </div>


                                    <div style="width: 300px; float: right; margin-right: 160px; text-align:left; ">
                                        <label for="sotaikhoan" style="margin-top: 4px">Số Tài Khoản:</label>
                                        <input id="sotaikhoan" class="form-control" type="text"
                                            aria-label=".form-control-lg example"
                                            placeholder="{{ session('user')->CUS_Stk }}" name="CUS_Stk">
                                        <br>
                                    </div>



                                    <div style=" text-align:center;">

                                        <a style="width:90px; float: left; margin-left: 396px ; margin-top: -6px"
                                            href="{{ route('User.Home') }}" type="button"
                                            class="btn btn-outline-secondary">
                                            Trở về </a>
                                        <button style="float: right; margin-right: 398px; margin-top: -6px" type="submit"
                                            class="btn btn-info"> Cập nhật </button>

                                    </div>

                                </div>
                            @else
                                <h1
                                    style="text-align: center; padding-top: 240px; font-size: 22px;  color:rgb(86, 86, 86);">
                                    BẠN CHƯA ĐĂNG NHẬP TÀI KHOẢN VÀO HỆ THỐNG
                                    <br>
                                    <a class="btn btn-info" href="{{ route('User.dangnhap') }}"
                                        style="text-decoration: none; margin-top: 8px">
                                        Đăng Nhập</a>
                                </h1>
                            @endif



                    </form>

                </div>



                <br>

            </div>





            <div class="col-md-3"
                style="background-color:#ffffff; width:356px; border-radius: 6px;margin-left:16px;margin-bottom:6px;height:642px;">
                @include('layouts.Right')
            </div>



        </main>


    </div>



    </div>
@endsection




{{-- @section('css')
    .col-md-1{
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
    }
@endsection --}}
