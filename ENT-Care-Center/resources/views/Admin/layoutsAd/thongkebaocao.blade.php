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
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:20px">
                THỐNG KÊ SỐ LƯỢNG BỆNH NHÂN
            </h1>
            <div id="myfirstchart" style="height: 250px;"></div>
            {{-- <select id="select-date" class="form-select" aria-label="Default select example"
                style="width:200px; text-align:center">
                <option selected>Thống Kê Theo</option>
                <option value="7day">7 Ngày</option>
                <option value="30day">30 Ngày</option>
                <option value="365day">365 Ngày</option>
            </select>
        </div>
        <div id="chart" style="height: 500px; margin-top:60px"></div>
        <div id="text-data"></div> <!-- Thêm phần hiển thị văn bản cho thông tin thống kê -->
    </main> --}}

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        @endsection
