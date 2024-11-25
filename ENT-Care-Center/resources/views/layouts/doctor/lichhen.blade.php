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
    <main>
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">DANH
                SÁCH LỊCH HẸN</h1>


        </div>
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

        <form>
            <div class="form-group" style="padding-top: 10px; padding-bottom: 40px">
                <input type="text" name="search" id="search" style="width: 20%; " class="form-control"
                    placeholder="🔎 Tìm kiếm bệnh nhân...">
                <div id="suggestions"
                    style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10;">
                </div>
            </div>
        </form>


        <div style="text-align: right; margin-bottom: 20px;">
            @if ($All)
                <a href="{{ route('User.lichhen') }}" class="btn btn-primary">Xem Lịch Hẹn Hôm Nay</a>
            @else
                <a href="{{ route('User.lichhen', ['all' => true]) }}" class="btn btn-secondary">Xem Tất Cả</a>
            @endif
        </div>


        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr style="text-align: center">
                    <th scope="col">STT</th>
                    <th scope="col">Tên Bệnh Nhân</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Bác Sĩ Khám</th>
                    <th scope="col">Giờ Khám</th>
                    <th scope="col">Ngày Khám</th>
                    <th scope="col">Triệu Chứng</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody id="patient-list">
                @foreach ($Lichhen as $lh)
                    <tr style="text-align: center">
                        <td>{{ $loop->iteration }}</td>

                        <td> {{ $lh->CUS_Name }}</td>
                        <td>{{ date('d-m-Y', strtotime($lh->CUS_Birthday)) }} </td>
                        <td> {{ $lh->CUS_Phone }}</td>
                        <td> {{ $lh->LH_BSkham }}</td>
                        <td>{{ $lh->LH_Giokham }} </td>
                        <td>{{ date('d-m-Y', strtotime($lh->LH_Ngaykham)) }}</td>
                        <td> {{ $lh->LH_trieuchung }}</td>

                        <td>
                            @if ($lh->LH_trangthai == 0)
                                <a href="{{ route('User.khambenh', ['id' => $lh->LH_Id]) }}" class="btn btn-success">Chưa
                                    khám</a>
                            @else
                                <a href='{{ route('User.khambenh', ['id' => $lh->LH_Id]) }}' class="btn btn-secondary">Đã
                                    khám</a>
                            @endif

                        </td>


                        {{-- <td>
                            <a href="{{ route('Admin.xoalichhen', ['id' => $lh->LH_Id]) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val().toLowerCase();

                // Nếu ô tìm kiếm rỗng, hiển thị lại tất cả các dòng
                if (query === '') {
                    $('#patient-list tr').show();
                    return;
                }

                // Lọc các dòng trong bảng
                $('#patient-list tr').filter(function() {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(query) > -
                        1); // Hiện hoặc ẩn dòng dựa trên kết quả tìm kiếm
                });
            });
        });
    </script>
@endsection


@section('css')
@endsection
