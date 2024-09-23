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

                    <div class="container">
                        <h1 class="text-center my-4" style="font-size: 25px">LIÊN HỆ KHẨN CẤP</h1>

                        <div class="alert alert-danger text-center">
                            <p>Nếu bạn cần trợ giúp ngay lập tức, vui lòng liên hệ với chúng tôi qua các thông tin dưới đây:
                            </p>
                            <h3 class="font-weight-bold">Số điện thoại khẩn cấp: <span style="color: red;">+84 924 546
                                    770</span></h3>
                            <p style="font-weight:bold;">Email: <a style="text-decoration: none;"
                                    href="mailto:entcareccenter@gmail.com">entcareccenter@gmail.com</a></p>
                        </div>


                        <h1 class="text-center my-4" style="font-size: 25px">GỬI TIN NHẮN CHO CHÚNG TÔI</h1>
                        <div class="form-container" style=" margin-top: 35px; font-weight:bold">
                            <form method="POST" action="{{ route('User.postlienhe') }}"
                                style="width: 50%; margin: 0 auto;">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên của bạn:</label>
                                    <input type="text" class="form-control" id="name" name="ten" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Tin nhắn:</label>
                                    <textarea class="form-control" id="message" name="mess" rows="2" required></textarea>
                                </div>
                                <div style="text-align:center;">
                                    <button type="submit" style="width:100px; margin-top: 6px"
                                        class="btn btn-primary">Gửi</button>
                                </div>

                            </form>
                        </div>

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
