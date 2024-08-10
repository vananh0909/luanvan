@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    {{-- <h1>Trang home nef</h1> --}}
    <div style=" background: linear-gradient(rgba(127, 168, 209, 0.3) ,rgba(68, 158, 210, 0.8)); height: auto;
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
                    <div style="text-align:center; margin-top: 6px; padding-bottom: 8px">
                        <h1 style=" font-size: 24px; "> DANH SÁCH BÁC SĨ</h1>

                    </div>
                    <div style="background-color: rgb(234, 235, 239); width: 1000px; border-radius:6px; margin:0 auto"
                        class="col-md-6">
                        <br>
                        @foreach ($bacsi as $bs)
                            <div id="right"
                                style="display: flex; background-color: #ffffff; width: 900px; height: 180px; margin: 0 auto; border-radius: 6px; overflow: auto;">
                                <div style="flex: 1; margin: 10px;">
                                    <img style="width: 135px; height: 158px; border-radius: 6px;"
                                        src="{{ asset('uploads/avtnhanvien/' . $bs->NV_Avatar) }} ">
                                </div>
                                <div style="flex: 2; margin-right: 30px ">
                                    <h3 style="font-size: 18px; color: rgba(68, 158, 210, 0.8); margin-top:10px">
                                        {{ $bs->NV_Ten }}</h3>
                                    <p><i class="fa-solid fa-graduation-cap"></i> Thạc sĩ, Bác sĩ</p>
                                    <p style="width:700px;text-align: justify;"> {{ $bs->NV_Gioithieu }}</p>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <br>
                    </div>
                </div>


                <div class="col-md-3"
                    style="background-color:#ffffff; width:356px; border-radius: 6px;margin-left:16px;margin-bottom:6px;height:642px;">
                    @include('layouts.Right')
                </div>
            </div>



        </main>


    </div>
@endsection






@section('css')
    #doctors:hover{
    border: 2px solid rgb(213, 210, 210);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); /* Đổ bóng */
    }
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
@endsection
