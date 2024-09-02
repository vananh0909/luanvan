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
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">XEM LỊCH
                TRỰC</h1>


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
        <div style="margin-left: 154px; margin-bottom:10px">
            <a href="{{ route('Admin.doctor') }}"><i style="color:rgb(99, 96, 96); font-size: 20px"
                    class="fas fa-backward"></i></a>
        </div>
        <table class="table table-striped" style="width: 75%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ngày Trực </th>
                    <th scope="col">Giờ Trực </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($xemlichtruc as $ltbs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($ltbs->lt_Ngaytruc)) }}</td>
                        <td>
                            @foreach (explode(',', $ltbs->giotruc_list) as $time)
                                <span class="btn btn-success" style="margin-left:4px">{{ $time }}</span>
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


    </main>
@endsection


@section('css')
    .hover:hover{
    color:red;
    }
@endsection
