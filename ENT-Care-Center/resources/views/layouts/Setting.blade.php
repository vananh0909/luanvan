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

                        <div style=" width: 1000px; height:594px;  margin:0 auto;"class="col-md-6">

                            @if (session('user'))
                                <div class="container-fluid"
                                    style="max-width: 600px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top:16px">

                                    <div style="text-align:center; margin-top: 2px; padding-bottom: 8px">
                                        <h1 style=" font-size: 22px; "> CÀI ĐẶT TÀI KHOẢN</h1>

                                    </div>

                                    {{-- Avatar --}}
                                    <div class="text-center mb-4">
                                        <img class="rounded-circle" style="width: 130px; height: 130px;"
                                            src="{{ asset('uploads/avtkhachhang/' . session('user')->CUS_Avatar) }}">
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Tên:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Ngày Sinh:</div>
                                        <div class="col-sm-8">{{ date('d-m-Y', strtotime(session('user')->CUS_Birthday)) }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Giới tính:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Gender }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Số điện thoại:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Phone }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Email:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Email }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Địa chỉ:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Address }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 "style="font-weight: bold">Ngân Hàng:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Nganhang }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 " style="font-weight: bold">Số tài khoản:</div>
                                        <div class="col-sm-8">{{ session('user')->CUS_Stk }}</div>
                                    </div>

                                    <div class="text-center mt-3" style="margin-top: 8px">
                                        <a href="{{ route('User.Home') }}" class="btn btn-secondary mr-2"
                                            style="width: 100px;">Trở về</a>
                                        <a href="{{ route('User.suatrangcanhan', ['id' => session('user')->CUS_Id]) }}"
                                            class="btn btn-primary" style="width: 100px;">Sửa</a>
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
