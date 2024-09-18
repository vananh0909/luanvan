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
        @if (session('status'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Thành Công ✅",
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
                        title: "Thất Bại ❌",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif
        <main>

            <div class="row">
                <div class="col-md-8" style="background-color:rgb(234, 235, 239); margin-left: 6px">



                    <div style=" width: 1000px; height:auto;  margin:0 auto;"class="col-md-6">

                        @if (session('user'))
                            <div class="container-fluid"
                                style="max-width: 700px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top:16px">

                                <form action="{{ route('User.posttrangcanhan', ['id' => $trangcn->CUS_Id]) }}"
                                    method="POST" style="width: 60%; margin: 0 auto; padding-top:58px"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="name" style="font-weight:bold; margin-bottom:4px">Tên:
                                        </label>
                                        <input type="text" class="form-control" id="tenthuoc" name="CUS_Name"
                                            value="{{ $trangcn->CUS_Name }}" required>
                                    </div>

                                    <div class="form-group ">
                                        <label for="avt" style="font-weight:bold; margin-bottom:4px">Ảnh đại diện:
                                        </label>
                                        <input type="file" class="form-control" id="tenthuoc" name="CUS_Avatar"
                                            value="{{ $trangcn->CUS_Avatar }}" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="phone" style="font-weight:bold; margin-bottom:4px; margin-top:4px">
                                            Ngày Sinh:
                                        </label>
                                        <input type="date" class="form-control" id="soluong" name="CUS_Birthday"
                                            value="{{ $trangcn->CUS_Birthday }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email"
                                            style="font-weight:bold; margin-bottom:4px; margin-top:4px; margin-right: 40px">Giới
                                            Tính: </label>
                                        <input type="radio" id="male" name="CUS_Gender" value="Nam"
                                            {{ $trangcn->CUS_Gender == 'Nam' ? 'checked' : '' }}>
                                        <label style="margin-right: 10px" for="male">Nam</label>

                                        <input type="radio" id="female" name="CUS_Gender" value="Nữ"
                                            {{ $trangcn->CUS_Gender == 'Nữ' ? 'checked' : '' }}>
                                        <label for="female">Nữ</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" style="font-weight:bold; margin-bottom:4px; margin-top:4px">
                                            Số điện thoại:
                                        </label>
                                        <input type="text" class="form-control" id="soluong" name="CUS_Phone"
                                            value="{{ $trangcn->CUS_Phone }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" style="font-weight:bold; margin-bottom:4px; margin-top:4px">
                                            Email:
                                        </label>
                                        <input type="text" class="form-control" id="soluong" name="CUS_Email"
                                            value="{{ $trangcn->CUS_Email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="diachi" style="font-weight:bold; margin-bottom:4px; margin-top:4px">
                                            Địa chỉ:
                                        </label>
                                        <input type="text" class="form-control" id="soluong" name="CUS_Address"
                                            value="{{ $trangcn->CUS_Address }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nganhang" style="font-weight:bold; margin-bottom:4px; margin-top:4px">
                                            Ngân hàng:
                                        </label>
                                        <input type="text" class="form-control" id="soluong" name="CUS_Nganhang"
                                            value="{{ $trangcn->CUS_Nganhang }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="stk" style="font-weight:bold; margin-bottom:4px; margin-top:4px">
                                            Số tài khoản:
                                        </label>
                                        <input type="text" class="form-control" id="soluong" name="CUS_Stk"
                                            value="{{ $trangcn->CUS_Stk }}" required>
                                    </div>

                                    <br>
                                    <div class="text-center mt-3" style="margin-top: 8px">
                                        <a href="{{ route('User.Setting') }}" class="btn btn-secondary mr-2"
                                            style="width: 100px;">Trở về</a>
                                        <button type="submit" class="btn btn-primary" style="width: 100px;">Cập nhật
                                        </button>
                                    </div>

                                </form>

                            </div>
                            <br>
                        @else
                            <h1 style="text-align: center; padding-top: 240px; font-size: 22px;  color:rgb(86, 86, 86);">
                                BẠN CHƯA ĐĂNG NHẬP TÀI KHOẢN VÀO HỆ THỐNG
                                <br>
                                <a class="btn btn-info" href="{{ route('User.dangnhap') }}"
                                    style="text-decoration: none; margin-top: 8px">
                                    Đăng Nhập</a>
                            </h1>
                        @endif




                    </div>




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
