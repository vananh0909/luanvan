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
                        title: " Thành Công ✅",
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
                    <div style="text-align:center; margin-top: 6px; padding-bottom: 8px">
                        <h1 style=" font-size: 24px;  color:rgb(86, 86, 86); "> ĐĂNG KÍ LỊCH KHÁM </h1>
                    </div>

                    @if (session('user'))
                        {{-- <p>Xin chào, {{ session('user')->CUS_Name }}</p> --}}

                        <div style="background-color: #ffffff; width: 1000px; height:584px; border-radius:6px; margin:0 auto"
                            class="col-md-6">
                            <form method="POST" action="{{ route('User.postlichkham') }}">
                                @csrf
                                <div style="padding-top: 8px">
                                    <p style=" margin-left: 8px"> Chọn bác sĩ khám (<span style="color:red">*</span>) Dưới
                                        đây là danh sách bác sĩ trực trong ngày hôm nay</p>

                                    <select class="form-select" style=" width: 400px; margin: 0 auto; padding: 6px"
                                        aria-label="Default select example" name="LH_BSkham" required>
                                        <option required selected> Chọn bác sĩ khám </option>
                                        @foreach ($bacsitruc as $bs)
                                            <option value="{{ $bs->lt_tenbs }}">{{ $bs->lt_tenbs }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin: 10px">
                                    <p> Ngày khám (<span style="color:red">*</span>)</p>
                                    <div style=" width: 400px; margin: 0 auto; ">
                                        <input style="margin-top: 10px; margin-bottom: 10px" id="ngaykham"
                                            class="form-control" type="date" aria-label=".form-control-lg example"
                                            name="LH_Ngaykham" required>


                                    </div>
                                    <p>Giờ khám (<span style="color:red">*</span>)</p>

                                    <div style="text-align:center; margin:12px">
                                        <select class="form-select" style=" width: 300px; margin: 0 auto; padding: 6px"
                                            aria-label="Default select example" name="LH_Giokham" required>
                                            <option selected> Chọn Giờ Khám </option>
                                            <option value="08:00">08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                        </select>



                                    </div>
                                    <div>
                                        <p>Nhập Email (<span style="color:red">*</span>)</p>
                                        <input style="width: 365px; margin: 0 auto" class="form-control" type="email"
                                            placeholder=' Để lại gmail nhận thông tin lịch hẹn'
                                            aria-label=".form-control-lg example" name="LH_Email" required>

                                    </div>

                                    <div>
                                        <p> Nhập rõ triệu chứng (<span style="color:red">*</span>)</p>
                                        <textarea style="width: 365px; margin: 0 auto" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            type="text" placeholder='Vui lòng mô tả rõ triệu chứng của bạn và nhu cầu thăm khám' name="LH_trieuchung"
                                            required></textarea>

                                    </div>

                                    <p style="font-size:12px; font-weight:bold; color:rgb(86, 86, 86); margin-top: 16px">
                                        Lưu ý:
                                        Thời
                                        gian khám trên
                                        chỉ là thời gian dự
                                        kiến, chúng tôi sẽ liên hệ xác nhận thời gian
                                        khám chính xác tới quý khách sau khi quý khách đặt hẹn</p>


                                    <div style="text-align:center;margin-top: 16px">
                                        <a style="width:82px; margin-right:4px"
                                            href="{{ route('User.Home') }}"class="btn btn-outline-secondary">
                                            Trở lại</a>
                                        <button type="submit" class="btn btn-info">Đặt Lịch</button>
                                    </div>

                                </div>

                            </form>
                            @if (session('status'))
                                <div style="padding-top:60px">
                                    <h4 style="width: 300px; height:10px; margin: 0 auto;font-size:18px; text-align:center; padding-bottom:40px;"
                                        class="alert alert-success">
                                        {{ session('status') }}
                                    </h4>
                                </div>
                            @elseif (session('error'))
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            title: "Đặt Lịch Thất Bại ❌",
                                            text: "{{ session('error') }}",
                                            icon: "error",
                                            confirmButtonText: "OK"
                                        });
                                    });
                                </script>
                            @endif


                        </div>
                    @else
                        <div style="background-color: #ffffff; width: 1000px; height:584px; border-radius:6px; margin:0 auto"
                            class="col-md-6">

                            <h1 style="text-align: center; padding-top: 240px; font-size: 22px;  color:rgb(86, 86, 86);">
                                XIN VUI LÒNG ĐĂNG NHẬP ĐỂ ĐĂNG KÝ LỊCH KHÁM

                                <br>
                                <a class="btn btn-info" href="{{ route('User.dangnhap') }}"
                                    style="text-decoration: none; margin-top: 8px">Đăng
                                    Nhập</a>
                            </h1>
                        </div>
                    @endif
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
