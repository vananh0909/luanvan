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
            <div style="margin-left: 266px; margin-bottom:6px; margin-top:-10px">
                <a href="{{ route('Admin.doctor') }}"><i style="color:rgb(99, 96, 96); font-size:20px;"
                        class="fas fa-backward"></i></a>
            </div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 6px; padding-bottom:30px">
                SỬA LỊCH TRỰC
            </h1>
        </div>

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



        <form action="{{ route('Admin.postsualichtruc', ['id' => $sualichtruc->lt_Idlt]) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <table class="table table-striped" style="width: 60%; margin: 0 auto; height:370px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-top: 16px;">
                            <label for="doctor_name">Tên Bác Sĩ:</label>
                            <input type="text" class="form-control" name="lt_tenbacsi"
                                value="{{ $sualichtruc->lt_tenbacsi }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 12px;">
                            <label for="schedule_date">Ngày Đăng Ký:</label>
                            <input type="date" id="schedule_date" class="form-control" name="lt_ngaytruc"
                                style="width:100%;" value="{{ $sualichtruc->lt_ngaytruc }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 12px;">
                            <label>Giờ Đăng Ký:</label>
                            <div style="text-align:center; margin:12px">
                                @php
                                    $selectedTimes = explode(', ', $sualichtruc->lt_giotruc);
                                @endphp
                                @foreach (['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'] as $time)
                                    <div style="display: inline-block; margin: 5px;">
                                        <input type="checkbox" name="lt_giotruc[]" value="{{ $time }}"
                                            {{ in_array($time, $selectedTimes) ? 'checked' : '' }}>
                                        {{ $time }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-top: 35px;">
                            <button type="submit" class="btn btn-light">Sửa Lịch Trực</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <div style="text-align: center; margin-top: 12px;">
            <p style="font-size: 13px;">
                Vui lòng chỉ đăng ký lịch trực trong một tuần. Không đăng ký hai tuần liên tiếp!
                <a href="{{ route('Admin.xemlichtruc') }}" class="hover">Xem lịch trực</a>
            </p>
        </div>

        <br>

    </main>
@endsection

@section('css')
    .hover:hover {
    color: red;
    }
@endsection
