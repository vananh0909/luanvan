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
        @endif
        <div style="margin-left: 154px">
            <a href="{{ route('Admin.doctor') }}"><i style="color:rgb(99, 96, 96)" class="fas fa-backward"></i></a>
        </div>
        <table class="table table-striped" style="width: 80%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ngày Trực </th>
                    <th scope="col">Giờ Trực </th>
                    <th scope="col"></th>

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
                        <td>
                            <a href="#" class="btn btn-primary d-inline-block"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            {{-- 
                            @php
                                $first_id = explode(', ', $ltbs->id_list)[0];
                            @endphp
                            <form action="{{ route('Admin.xoalichtrucbs', ['id' => $first_id]) }}" method="POST"
                                class="d-inline-block"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhóm lịch trực này?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form> --}}
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
