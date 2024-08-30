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
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:20px">
                SỬA LỊCH TRỰC

            </h1>

        </div>



        <form method="POST" action="{{ route('Admin.editlichtruc', ['id' => $lichtruc->lt_Id]) }}">
            @csrf
            <table class="table table-striped" style="width: 50%; margin: 0 auto; ">

                <tbody>

                    <tr>
                        <th scope="row">Tên Bác Sĩ</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" name="lt_tenbacsi" required>
                                <option selected>{{ $lichtruc->lt_tenbacsi }}</option>
                                @foreach ($bacsi as $bs)
                                    <option value="{{ $bs->NV_Ten }}">{{ $bs->NV_Ten }}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Ngày Trực</th>
                        <td><input type="date" name="lt_Ngaytruc" class="form-control"
                                value="{{ $lichtruc->lt_Ngaytruc }}" required>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td>
                            <a href="{{ route('Admin.quanlybacsy') }}" class="btn btn-light" style="margin-left: 5px">Trở
                                Về</a>
                            <button type="submit" class="btn btn-primary" style="margin-left: 5px">Cập Nhật Lịch
                                Trực</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>

        </form>
    @endsection


    @section('css')
    @endsection
