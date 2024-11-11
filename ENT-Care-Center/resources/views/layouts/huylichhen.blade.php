@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div style="background: linear-gradient(rgba(127, 168, 209, 0.3), rgba(68, 158, 210, 0.8)); height: 728px; position: fixed; top: 0; left: 0; bottom: 0;"
        class="col-md-1">
        @include('layouts.Sidebar')
    </div>
    <div style="flex: 1; padding-left: 104px;" class="col-md-11">
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
                <div class="col-md-8" style="background-color: rgb(234, 235, 239); margin-left: 6px">
                    <div style="background-color: #ffffff; width: 1000px; height: 636px; border-radius: 6px; margin: 0 auto"
                        class="col-md-6">
                        @if (session('user'))
                            <div style="margin-left: 8px; padding-top: 4px">
                                @if ($lichhen)
                                    <div class="container mt-4">
                                        <h2 style="text-align: center;">Danh sách lịch hẹn của bạn</h2>
                                        <table class="table table-bordered table-striped mt-3">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Ngày Khám</th>
                                                    <th scope="col">Giờ Khám</th>
                                                    <th scope="col">Bác Sĩ Khám</th>
                                                    <th scope="col">Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lichhen as $lh)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($lh->LH_Ngaykham)) }}</td>
                                                        <td>{{ $lh->LH_Giokham }}</td>
                                                        <td>{{ $lh->LH_BSkham }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                @php
                                                                    $TimeNow = Carbon\Carbon::now();

                                                                    //  thời gian hẹn khám từ lịch hẹn
                                                                    $time = Carbon\Carbon::parse(
                                                                        $lh->LH_Ngaykham . ' ' . $lh->LH_Giokham,
                                                                    );
                                                                @endphp
                                                                @if ($TimeNow->lessThan($time))
                                                                    <form
                                                                        action="{{ route('User.posthuylichhen', $lh->LH_Id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger"
                                                                            onclick="return confirm('Bạn có chắc muốn hủy lịch hẹn này?')">
                                                                            Hủy lịch hẹn
                                                                        </button>
                                                                    </form>

                                                                    <a href="{{ route('User.sualichhen', $lh->LH_Id) }}"
                                                                        class="btn btn-warning"
                                                                        style="margin-left: 4px">Chỉnh sửa</a>
                                                                @else
                                                                    <span style="color: gray;">Lịch hẹn đã qua</span>
                                                                @endif

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>Không có lịch hẹn!</p>
                                @endif
                            </div>
                        @else
                            <div style="background-color: #ffffff; width: 1000px; height:584px; border-radius:6px; margin:0 auto"
                                class="col-md-6">

                                <h1
                                    style="text-align: center; padding-top: 240px; font-size: 22px;  color:rgb(86, 86, 86);">
                                    XIN VUI LÒNG ĐĂNG NHẬP ĐỂ XEM

                                    <br>
                                    <a class="btn btn-info" href="{{ route('User.dangnhap') }}"
                                        style="text-decoration: none; margin-top: 8px">Đăng
                                        Nhập</a>
                                </h1>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-3"
                    style="background-color: #ffffff; width: 356px; border-radius: 6px; margin-left: 16px; margin-bottom: 6px; height: 642px;">
                    @include('layouts.Right')
                </div>
            </div>
        </main>
    </div>
@endsection

@section('css')
    .col-md-1 {
    margin-right: 34px;
    width: 65px;
    }
    .header {
    height: 60px;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    }
    .col-md-8 {
    width: 1000px;
    margin-right: 25px;
    border-radius: 6px;
    }
    footer {
    background-color: green;
    }
@endsection
