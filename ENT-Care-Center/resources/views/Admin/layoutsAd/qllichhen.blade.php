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
                SÁCH LỊCH HẸN</h1>


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
                    <th scope="col">Tên Bệnh Nhân</th>
                    <th scope="col">Ngày Sinh</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">Bác Sĩ Khám</th>
                    <th scope="col">Giờ Khám</th>
                    <th scope="col">Ngày Khám</th>
                    <th scope="col">Triệu Chứng</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($Lichhen as $lh)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td> {{ $lh->CUS_Name }}</td>
                        <td>{{ date('d-m-Y', strtotime($lh->CUS_Birthday)) }} </td>
                        <td> {{ $lh->CUS_Phone }}</td>
                        <td> {{ $lh->LH_Email }}</td>
                        <td> {{ $lh->LH_BSkham }}</td>
                        <td>{{ $lh->LH_Giokham }} </td>
                        <td> {{ $lh->LH_Ngaykham }}</td>
                        <td> {{ $lh->LH_trieuchung }}</td>


                        {{-- <td>
                            <a href="{{ route('Admin.xoalichhen', ['id' => $lh->LH_Id]) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td> --}}

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
