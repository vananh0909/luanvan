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
                SÁCH BỆNH NHÂN</h1>


        </div>
        @if (session('status'))
            <h4 style="width: 750px; height:30px; margin: 0 auto;font-size:20px; text-align:center; padding-bottom:40px"
                class="alert alert-success">
                {{ session('status') }}</h4>
        @endif

        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Giới Tính</th>
                    <th scope="col">Địa Chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Ngân Hàng</th>
                    <th scope="col">STK</th>
                    <th scope="col">Lịch Sử Khám</th>
                    <th scope="col">Hành Động</th>




                </tr>
            </thead>
            <tbody>
                @foreach ($khachhang as $kh)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('uploads/avtkhachhang/' . $kh->CUS_Avatar) }} "
                                style="width:70px; height: 70px"> </td>
                        <td>{{ $kh->CUS_Name }} </td>
                        <td> {{ date('d-m-Y', strtotime($kh->CUS_Birthday)) }}</td>
                        <td> {{ $kh->CUS_Gender }}</td>
                        <td> {{ $kh->CUS_Address }}</td>
                        <td>{{ $kh->CUS_Email }} </td>
                        <td> {{ $kh->CUS_Phone }}</td>
                        <td>{{ $kh->CUS_Nganhang }} </td>
                        <td> {{ $kh->CUS_Stk }}</td>
                        <td><i class="fa-solid fa-clock-rotate-left"></i></td>
                        <td>
                            <a href="{{ route('Admin.suathongtin', ['id' => $kh->CUS_Id]) }}" class="btn btn-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            <a href="{{ route('Admin.xoabenhnhan', ['id' => $kh->CUS_Id]) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    </main>




    </div>
@endsection


@section('css')
@endsection
