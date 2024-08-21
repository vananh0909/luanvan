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

        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 40px; padding-bottom:40px">
                LỊCH TRỰC</h1>
        </div>

        <div style="margin: 10px 0 30px 80px; font-size:20px">
            <a href="{{ route('Admin.quanlybacsy') }}"><i style="color:rgb(99, 96, 96)" class="fas fa-backward"></i></a>
        </div>

        <table class="table table-striped" style="width: 90%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">Tên Bác Sĩ</th>
                    <th scope="col">Ngày Trực</th>
                    <th scope="col">Giờ Trực</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lichtruc as $lt)
                    <tr>
                        <td>{{ $lt->lt_tenbs }}</td>
                        <td>{{ date('d-m-Y', strtotime($lt->lt_Ngaytruc)) }}</td>
                        <td>
                            @foreach (explode(',', $lt->giotruc_list) as $time)
                                <span class="btn btn-success" style="margin-left:4px">{{ $time }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <br>

    </main>
    </div>



    </div>
@endsection


@section('css')
@endsection
