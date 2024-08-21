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
        {{--
        <a href="{{ route('Admin.themnhanvien') }}" class="btn btn-primary" style="margin-left:12px; margin-bottom: 10px">Thêm
            nhân viên</a> --}}

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
            <tbody>
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

                            <a href="{{ route('Admin.xoanhanvien', ['id' => $nv->id]) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
