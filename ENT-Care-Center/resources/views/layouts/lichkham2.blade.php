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



                    <div style="background-color: #ffffff; width: 1000px; height:636px; border-radius:6px; margin:0 auto"
                        class="col-md-6">
                        <div style=" margin-left:8px; padding-top: 4px">
                            <div style="text-align:center; margin-top: 6px;">
                                <h1 style=" font-size: 24px; "> THÔNG TIN LỊCH HẸN </h1>

                            </div>
                            <hr style="margin-left:-8px; color:#a1a1a1">
                            <h2 style="font-size:18px; font-weight:bold; color:rgb(77, 141, 197)"> Dịch vụ </h2>
                            <div style=" margin-top: 10px">
                                <p style="font-size:16px; display: inline-block; margin-right:60px"> Hình thức : </p>
                                <p style="font-size:16px; display: inline-block;"> Khám trực tiếp tại phòng khám </p>
                            </div>


                            <h2 style="font-size:18px; font-weight:bold; color:rgb(77, 141, 197)"> Khách hàng</h2>
                            <div style=" margin-top: 10px;font-size:16px;">
                                @if ($allData)
                                    @foreach ($allData as $data)
                                        <p style="display: inline-block; margin-right:104px"> Tên : </p>
                                        <p style="display: inline-block;"> {{ $data->CUS_Name }}</p>

                                        <div>
                                            <p style="display: inline-block; margin-right:64px"> Giới Tính : </p>
                                            <p style="display: inline-block;"> {{ $data->CUS_Gender }}</p>
                                        </div>
                                        <div>
                                            <p style="display: inline-block; margin-right:58px"> Ngày sinh : </p>
                                            <p style="display: inline-block;">
                                                {{ date('d-m-Y', strtotime($data->CUS_Birthday)) }}</p>
                                        </div>

                                        <div>
                                            <p style="display: inline-block; margin-right:36px"> Số điện thoại : </p>
                                            <p style="display: inline-block;"> {{ $data->CUS_Phone }} </p>
                                        </div>

                                        <div>
                                            <p style="display: inline-block; margin-right:82px"> Email : </p>
                                            <p style="display: inline-block;"> {{ $data->LH_Email }} </p>
                                        </div>

                                        <div>
                                            <p style="display: inline-block; margin-right:50px"> Triệu Chứng : </p>
                                            <p style="display: inline-block;"> {{ $data->LH_trieuchung }} </p>
                                        </div>
                            </div>


                            <h2 style="font-size:18px; font-weight:bold; color:rgb(77, 141, 197)"> Bác Sĩ </h2>
                            <div style=" margin-top: 10px">
                                <p style="font-size:16px; display: inline-block; margin-right:104px"> Tên : </p>
                                <p style="font-size:16px; display: inline-block;"> {{ $data->LH_BSkham }} </p>

                                <div>

                                    <p style="font-size:16px; display: inline-block; margin-right:28px"> Thời gian khám:
                                    </p>
                                    <p style="font-size:16px; display: inline-block;">
                                        Ngày {{ date('d-m-Y', strtotime($data->LH_Ngaykham)) }}
                                    </p>

                                    <p style="font-size:16px; display: inline-block;"> Vào lúc {{ $data->LH_Giokham }}</p>

                                </div>

                                <div>
                                    <p style="font-size:16px; display: inline-block; margin-right:82px">Địa chỉ:</p>
                                    <p style="font-size:16px; display: inline-block;">Đường 3/2, phường Xuân Khánh, Ninh
                                        Kiều, Cần Thơ</p>
                                </div>
                                @endforeach
                            @else
                                <p>No data available</p>
                                @endif
                            </div>
                            <div style=" text-align:center; margin-top:6px">

                                <a style="width:82px; margin-right:10px" href="{{ route('User.lichkham') }}"
                                    class="btn btn-outline-secondary">
                                    Trở lại</a>
                                <a id="xacnhan" href="{{ route('sendmail') }}" class="btn btn-info"> Xong </a>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const confirmButton = document.getElementById('xacnhan');
                                        confirmButton.addEventListener('click', function() {
                                            Swal.fire({
                                                title: "Thông tin đã được xác nhận ✅",
                                                text: "Chúng Tôi Sẽ Liên Hệ Đến Bạn Trong Thời Gian Sớm Nhất",
                                                icon: "success"
                                            });
                                        });
                                    });
                                </script>

                            </div>


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



    </div>
@endsection




@section('css')
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
