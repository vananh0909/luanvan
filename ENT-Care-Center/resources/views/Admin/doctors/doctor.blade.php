@extends('Admin.Clients.ClientAd')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <header>
        @include('Admin.layoutsAd.HeaderAd')
    </header>
    <main>
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">
                ĐĂNG KÝ LỊCH TRỰC
            </h1>
        </div>

        @if (session('status'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Đặt Lịch Thành Công ✅",
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
                        title: "Đặt Lịch Thất Bại ❌",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <table class="table table-striped" style="width: 60%;margin: 0 auto ; height:315px">
            <form action="{{ route('Admin.postdoctor') }}" method="POST">
                @csrf
                <tbody>
                    <tr>
                        <td>
                            <label style="margin-top: 16px">Ngày Đăng Ký:</label>
                            <input type="date" class="form-control" id="schedule_date" name="lt_ngaytruc"
                                style="width:400px; margin: 0 auto" required>

                            <label style="margin-top: 12px">Giờ Đăng Ký:</label>
                            <div style="text-align:center; margin:12px">
                                @foreach (['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'] as $time)
                                    <div style="display: inline-block; margin: 5px;">
                                        <input type="checkbox" name="lt_giotruc[]" value="{{ $time }}">
                                        {{ $time }}
                                    </div>
                                @endforeach
                            </div>


                            <div class="d-flex justify-content-center" style="margin-top: 24px;">
                                <button type="submit" class="btn btn-light">Đăng ký</button>
                            </div>
                            <div>
                                <p style="font-size:13px; text-align:center; margin-top: 56px">
                                    Vui lòng chỉ đăng ký lịch trực trong một tuần. Không đăng ký hai tuần liên tiếp !
                                    <a href="{{ route('Admin.xemlichtruc') }}" class="hover"> Xem lịch trực</a>
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </form>
        </table>

        <br>
        <br>
        <br>
        <br>
        <br>

    </main>
@endsection

@section('css')
    .hover:hover{
    color:red;
    }
@endsection
