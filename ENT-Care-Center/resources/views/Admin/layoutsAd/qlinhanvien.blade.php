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
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">DANH
                SÁCH NHÂN VIÊN</h1>
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
                    placeholder="🔎 Tìm kiếm nhân viên...">
                <div id="suggestions"
                    style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10;">
                </div>
            </div>
        </form>

        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên Nhân Viên</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Giới Tính</th>
                    <th scope="col">Địa Chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Trình Độ</th>
                    <th scope="col">Chức Vụ</th>
                    <th scope="col">Giới Thiệu</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody id="patient-list">
                @foreach ($Nhanvien as $nv)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('uploads/avtnhanvien/' . $nv->NV_Avatar) }}"
                                style="width:70px; height: 70px"> </td>
                        <td>{{ $nv->name }} </td>
                        <td> {{ date('d-m-Y', strtotime($nv->NV_Birthday)) }}</td>
                        <td> {{ $nv->NV_Gioitinh }}</td>
                        <td> {{ $nv->NV_Diachi }}</td>
                        <td>{{ $nv->email }} </td>
                        <td> {{ $nv->phone }}</td>
                        <td>{{ $nv->NV_Trinhdo }} </td>
                        <td> {{ $nv->NV_Chucvu }}</td>
                        <td> {{ $nv->NV_Gioithieu }}</td>
                        <td>
                            <a href="{{ route('Admin.suanhanvien', ['id' => $nv->id]) }}" class="btn btn-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></a>

                            <a href="{{ route('Admin.xoanhanvien', ['id' => $nv->id]) }}" class="btn btn-danger"
                                style="margin-top: 2px"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
