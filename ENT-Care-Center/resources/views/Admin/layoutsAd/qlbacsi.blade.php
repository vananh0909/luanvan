@extends('Admin.Clients.ClientAd')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div style=" flex: 1;padding-left: 104px;">
        <header>
            @include('Admin.layoutsAd.HeaderAd')
        </header>
    </div>
    <main>
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:25px">
                PHÂN LỊCH TRỰC

            </h1>

        </div>

        @if (session('status'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Phân Lịch Thành Công ✅",
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
                        title: "Phân Lịch Thất Bại ❌",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        {{-- PHÂN LỊCH TRỰC --}}

        <form method="POST" action="{{ route('Admin.postlichtruc') }}">
            @csrf
            <table class="table table-striped" style="width: 56%; margin: 0 auto; height:320px ">

                <tbody>

                    <tr class="spacing-tr">
                        <th scope="row">Tên Bác Sĩ</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" name="lt_tenbs" required>
                                <option value="" disabled selected>Chọn tên bác sĩ</option>
                                @foreach ($doctors as $bs)
                                    <option value="{{ $bs->name }}">{{ $bs->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr class="spacing-tr">
                        <th scope="row">Ngày Trực</th>
                        <td><input type="date" name="lt_Ngaytruc" class="form-control" required> </td>
                    </tr>

                    <tr class="spacing-tr">
                        <th scope="row" style="margin-top: 14px">Giờ Đăng Ký:</th>
                        <td>
                            @foreach (['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'] as $time)
                                <div style="display: inline-block; margin: 5px;">
                                    <input type="checkbox" name="lt_Giotruc[]" value="{{ $time }}">
                                    {{ $time }}
                                </div>
                            @endforeach
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <th scope="row"> </th>
                        <td>
                            <button type="submit" class="btn btn-primary"
                                style="margin-left: 270px; margin-top: 16px; margin-bottom:16px">Thêm Lịch Trực</button>
                        </td>
                    </tr>



                </tbody>
            </table>
            <br>

        </form>

        {{-- LỊCH TRỐNG CỦA BÁC SĨ --}}
        <hr style="width:70%; margin:0 auto">

        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 40px; padding-bottom:40px"> LỊCH
                TRỐNG CỦA BÁC SĨ </h1>
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
                @foreach ($Lichtrucbs as $lt)
                    <tr>
                        <td>{{ $lt->lt_tenbacsi }}</td>
                        <td>{{ date('d-m-Y', strtotime($lt->lt_ngaytruc)) }}</td>
                        <td>
                            @foreach (explode(',', $lt->giotruc_list) as $time)
                                <span class="btn btn-success" style="margin-left:4px">{{ $time }}</span>
                            @endforeach
                        </td>
                        <td>

                            <a href="" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>


    </main>
    </div>



    </div>
@endsection


@section('css')
@endsection
