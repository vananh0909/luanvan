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

        <div>

            <div style="margin: 10px 0 30px 0px;">
                <a href="{{ route('Admin.quanlybacsy') }}"><i style="color:rgb(99, 96, 96);font-size:20px "
                        class="fas fa-backward"></i></a>
            </div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 10px; padding-bottom:40px">
                LỊCH TRỰC</h1>
        </div>


        <table class="table table-striped" style="width: 100%;margin: 0 auto">
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
                            @foreach (explode(', ', $lt->lt_Giotruc) as $time)
                                <span class="btn btn-success" style="margin-left:4px">{{ $time }}</span>
                            @endforeach
                        </td>
                        <td class="d-flex align-items-center">
                            <a href="{{ route('Admin.sualichsap', ['id' => $lt->lt_Id]) }}" class="btn btn-primary"
                                style="margin-right: 10px"><i class="fa-regular fa-pen-to-square"></i></a>

                            <form action="{{ route('Admin.xoalichsap', ['id' => $lt->lt_Id]) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa lịch sắp này?');">
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
        <br>

    </main>
    </div>



    </div>
@endsection


@section('css')
@endsection
