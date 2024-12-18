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
    <main style="font-family: Times New Roman, Times, serif;">


        <div class="container-fluid" style="background-color:rgb(234, 235, 239)">

            <div>
                <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">XEM
                    LỊCH TRỰC</h1>

            </div>

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
            <div style="margin-left: 4px; margin-bottom:10px">
                <a href="{{ route('User.lichhen') }}"><i class="fas fa-backward" style="color:gray"></i></a>
            </div>
            <table class="table table-striped" style="width: 100%;margin: 0 auto">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Ngày Trực </th>
                        <th scope="col">Giờ Trực </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($xemlichtruc as $ltbs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ltbs->lt_tenbs }}</td>
                            <td>{{ date('d-m-Y', strtotime($ltbs->lt_Ngaytruc)) }}</td>
                            <td>
                                @foreach (explode(', ', $ltbs->lt_Giotruc) as $time)
                                    <span class="btn btn-success"
                                        style="margin-left:4px; margin-top: 2px">{{ $time }}</span>
                                @endforeach
                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <br>
            <br>
            <br>

            <br>
            <br>

            <br>
            <br>

            <br>
            <br>



        </div>
    </main>
@endsection




@section('css')
@endsection
