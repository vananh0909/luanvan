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
            <header class="d-flex justify-content-between align-items-center mb-4">

                <a href="{{ route('Admin.themthuoc') }}" class="btn btn-primary btn-custom">Thêm Thuốc Mới</a>
            </header>


            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID Thuốc</th>
                        <th>Tên Thuốc</th>
                        <th>Số Lượng</th>
                        <th>Đơn Vị</th>
                        <th>Giá Thuốc</th>
                        <th>Liều Lượng</th>
                        <th>Cách Dùng</th>
                        <th>Mô Tả</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($khothuoc as $kt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kt->tenthuoc }}</td>
                            <td>{{ $kt->soluong }}</td>
                            <td>{{ $kt->donvi }}</td>
                            <td>{{ $kt->giathuoc }}</td>
                            <td>{{ $kt->lieuluong }}</td>
                            <td>{{ $kt->cachdung }}</td>
                            <td>{{ $kt->mota }}</td>
                            <td class="d-flex align-items-center">
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
@endsection

@section('css')
@endsection
