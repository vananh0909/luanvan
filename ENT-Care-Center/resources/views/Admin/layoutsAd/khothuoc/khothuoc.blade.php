@extends('Admin.Clients.ClientAd')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <header>
        @include('Admin.layoutsAd.HeaderAd')
    </header>
    <main>


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


        <div class="container">

            <div>
                <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">KHO
                    THUỐC</h1>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form class="flex-grow-1" style="margin-right: 10px;">
                    <div class="form-group" style="">
                        <input type="text" name="search" id="search" style="width: 20%;" class="form-control"
                            placeholder="🔎 Tìm thuốc...">
                        <div id="suggestions"
                            style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10;">
                        </div>
                    </div>
                </form>

                <a href="{{ route('Admin.themthuoc') }}" style="margin-top:5px" class="btn btn-primary btn-custom">Thêm
                    Thuốc Mới</a>
            </div>



            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID Thuốc</th>
                        <th>Tên Thuốc</th>
                        <th>Loại Thuốc</th>
                        <th>Số Lượng</th>
                        <th>Đơn Vị</th>
                        <th>Giá Thuốc</th>
                        <th>Liều Lượng</th>
                        <th>Cách Dùng</th>
                        <th>Mô Tả</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody id="patient-list">
                    @foreach ($khothuoc as $kt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kt->tenthuoc }}</td>
                            <td>{{ $kt->ten_loai }}</td>
                            <td>{{ $kt->soluong }}</td>
                            <td>{{ $kt->donvi }}</td>
                            <td>{{ $kt->giathuoc }}</td>
                            <td>{{ $kt->lieuluong }}</td>
                            <td>{{ $kt->cachdung }}</td>
                            <td>{{ $kt->mota }}</td>
                            <td class="d-flex align-items-center" style="padding-bottom:17px;padding-top:16px">
                                <a href="{{ route('Admin.suathuoc', ['id' => $kt->id_thuoc]) }}"
                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                                <form action="{{ route('Admin.xoathuoc', ['id' => $kt->id_thuoc]) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa thuốc này?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" style="font-size:11px; margin-left:4px">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>

    </main>
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
