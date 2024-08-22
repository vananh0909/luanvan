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
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 18px; padding-bottom:32px">
                LIỆT KÊ DANH SÁCH USERS
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
                        title: " ❌",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Điện Thoại</th>
                    <th scope="col">Password</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Bác Sĩ</th>
                    <th scope="col">Nhân viên quản lí</th>

                    <th scope="col" style="width: 30px"></th>



                </tr>
            </thead>
            <tbody>

                @foreach ($admin as $ad)
                    <form action="{{ route('phanquyen') }}" method="POST">
                        @csrf
                        <tr>
                            {{-- $loop->iteration trả về số thứ tự trong trang hiện tại
                            $admin->firstItem() trả về số thứ tự của mục đầu tiên trên trang hiện tại.
                             Cộng hai giá trị này và trừ 1 để có số thứ tự đúng trong toàn bộ danh sách. --}}
                            <td>{{ $loop->iteration + $admin->firstItem() - 1 }}</td>

                            <td> {{ $ad->name }}</td>
                            <td title="{{ $ad->email }}">{{ $ad->email }}

                                <input type="hidden" name="email" value="{{ $ad->email }}">

                            </td>
                            <td> {{ $ad->phone }}</td>
                            <td title="{{ $ad->password }}">{{ $ad->password }} </td>
                            <td>
                                {{-- khi admin có quyền gì thì nó sẽ so sánh bên bảng user_roles và check theo --}}
                                <input type="checkbox" name="admin_role" {{ $ad->hasRole('admin') ? 'checked' : '' }}>
                            </td>

                            <td>
                                <input type="checkbox" name="doctor_role" {{ $ad->hasRole('doctor') ? 'checked' : '' }}>
                            </td>

                            <td>
                                <input type="checkbox" name="nv_role"
                                    {{ $ad->hasRole('nhanvienquanli') ? 'checked' : '' }}>
                            </td>



                            <td>
                                <input type="submit" class="btn btn-light" value="Phân Quyền">
                            </td>

                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>


        <br>
        <div class="d-flex justify-content-center">
            {{ $admin->links('pagination::bootstrap-4') }}
        </div>



    </main>
@endsection

@section('css')
    .hover:hover{
    color:red;
    }


    .table {
    table-layout: fixed; /* Đảm bảo các cột có kích thước cố định */
    width: 100%; /* Đảm bảo bảng chiếm toàn bộ chiều rộng của phần tử chứa */
    }

    .table td, .table th {
    white-space: nowrap; /* Ngăn nội dung xuống dòng */
    overflow: hidden; /* Ẩn nội dung tràn */
    text-overflow: ellipsis; /* Thêm dấu ba chấm khi nội dung quá dài */
    }

    .table th {
    width: 11%; /* Điều chỉnh tỷ lệ kích thước cột theo nhu cầu */
    }

    .table td {
    width: 11%; /* Điều chỉnh tỷ lệ kích thước cột theo nhu cầu */
    }
@endsection
