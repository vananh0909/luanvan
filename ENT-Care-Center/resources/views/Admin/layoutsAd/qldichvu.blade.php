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
            <h4 style="width: 750px; height:30px; margin: 0 auto;font-size:20px; text-align:center; padding-bottom:40px"
                class="alert alert-success">
                {{ session('status') }}</h4>
        @endif
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">
                DANH SÁCH DỊCH VỤ</h1>


        </div>
        <a href="{{ route('Admin.themdichvu') }}" class="btn btn-primary" style="margin-left:12px; margin-bottom: 10px">
            Thêm Dịch Vụ</a>


        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Dịch Vụ</th>
                    <th scope="col">Giá Dịch Vụ</th>
                    <th scope="col">Hành Động</th>



                </tr>
            </thead>
            <tbody>
                @foreach ($Dichvu1 as $dv1)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dv1->DV_Tendv }} </td>
                        <td> {{ $dv1->DV_Gia }}</td>
                        <td>
                            <a href="{{ route('Admin.suadichvu', ['id' => $dv1->DV_ID]) }}" class="btn btn-primary"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                            <a href="{{ route('Admin.xoadichvu', ['id' => $dv1->DV_ID]) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <br>
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px">
                DANH SÁCH CÁC GÓI KHÁM</h1>


        </div>
        <a href="{{ route('Admin.themgoidichvu') }}" class="btn btn-primary" style="margin-left:12px; margin-bottom: 10px">
            Thêm Gói Khám</a>


        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên Gói Khám</th>
                    <th scope="col">Giới Thiệu Sơ Lược</th>
                    <th scope="col">Hành Động</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($Dichvu2 as $dv2)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('uploads/dichvu/' . $dv2->DV2_anhdv) }}" style="width:70px; height: 70px">
                        </td>
                        <td>{{ $dv2->DV2_Tendv }} </td>
                        <td> {{ $dv2->DV2_gioithieu }}</td>
                        <td>
                            <a href="{{ route('Admin.suagoidichvu', ['id' => $dv2->DV2_ID]) }}" class="btn btn-primary"
                                style="margin-bottom: 4px"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="{{ route('Admin.xoagoidichvu', ['id' => $dv2->DV2_ID]) }}" class="btn btn-danger"><i
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
