@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div>
        <header>
            @include('layouts.doctor.headerdoctor')
        </header>
    </div>
    <main style="font-family: Times New Roman, Times, serif;">

        <div>
            <a href="{{ route('User.lichhen') }}"><i class="fas fa-backward" style="color:gray"></i></a>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:30px">
                ĐĂNG KÝ LỊCH TRỰC
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


        <form action="{{ route('User.postdklichtruc') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <table class="table table-striped" style="width: 60%; margin: 0 auto; height:370px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-top: 16px;">
                            <label for="doctor_name">Tên Bác Sĩ:</label>
                            <input type="text" class="form-control" name="lt_tenbacsi" value="{{ $user->name }}"
                                required>

                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 12px;">
                            <label for="schedule_date">Ngày Đăng Ký:</label>
                            <input type="date" id="schedule_date" class="form-control" name="lt_ngaytruc"
                                style="width:100%;" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 12px;">
                            <label>Giờ Đăng Ký:</label>
                            <div style="text-align:center; margin:12px">
                                @foreach (['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'] as $time)
                                    <div style="display: inline-block; margin: 5px;">
                                        <input type="checkbox" name="lt_giotruc[]" value="{{ $time }}" checked>
                                        {{ $time }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding-top: 35px;">
                            <button type="submit" class="btn btn-light">Đăng ký</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <div style="text-align: center; margin-top: 12px;">
            <p style="font-size: 13px;">
                Vui lòng chỉ đăng ký lịch trực trong một tuần. Không đăng ký hai tuần liên tiếp !
                <a href="" class="hover">Xem lịch trực</a>
            </p>
        </div>

        <br>
        <hr style="width:80%; margin:0 auto">
        <br>
        <br>



        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:30px">
                LỊCH TRỰC ĐÃ ĐĂNG KÝ
            </h1>
        </div>

        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">Tên Bác Sĩ</th>
                    <th scope="col">Ngày Đăng Ký</th>
                    <th scope="col">Giờ Đăng Ký</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lichtruc as $lt)
                    <tr>
                        <td>{{ $lt->lt_tenbacsi }}</td>
                        <td>{{ date('d-m-Y', strtotime($lt->lt_ngaytruc)) }}</td>
                        <td>
                            @foreach (explode(', ', $lt->lt_giotruc) as $time)
                                <span class="btn btn-success" style="margin-left:4px">{{ $time }}</span>
                            @endforeach
                        </td>
                        <td class="d-flex align-items-center">


                            <a href="{{ route('User.sualichtrucdk', ['id' => $lt->lt_Idlt]) }}" class="btn btn-primary"
                                style="margin-right: 10px">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>


                            <form action="{{ route('User.xoalichtrucdk', ['id' => $lt->lt_Idlt]) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhóm lịch trực này?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash "></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <br>
        <br>

    </main>
@endsection

@section('css')
    .hover:hover {
    color: red;
    }
@endsection
