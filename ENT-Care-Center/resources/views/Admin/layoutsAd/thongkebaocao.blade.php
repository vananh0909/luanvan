@extends('Admin.Clients.ClientAd')

@section('title')
    {{ $title }}
@endsection


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>


@section('content')
    <header>
        @include('Admin.layoutsAd.HeaderAd')
    </header>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <main>
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:20px">
                THỐNG KÊ DOANH THU
            </h1>
            <div>
                <p>Thống kê đơn hàng theo : <span id="text-date"></span></p>
                <select class="form-select" style="width:8%">
                    <option selected>Số Ngày</option>
                    <option value="7ngay">7 Ngày</option>
                    <option value="28ngay">28 Ngày</option>
                    <option value="90ngay">90 Ngày</option>
                    <option value="365ngay">365 Ngày</option>
                </select>
            </div>
            <div id="myfirstchart" style="height: 330px; padding-bottom: 18px;margin-top:24px "></div>
            <br>

        </div>

    </main>


    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            thongke();
            var char = new Morris.Area({
                element: 'myfirstchart',
                xkey: 'ngay',
                ykeys: ['donthuoc', 'doanhthu'],
                labels: [' Đơn Thuốc', 'Doanh Thu'],


            });

            $('.form-select').change(function() {
                var thoigian = $(this).val();
                if (thoigian == '7ngay') {
                    var text = '7 Ngày';
                } else if (thoigian == '28ngay') {
                    var text = '28 Ngày';
                } else if (thoigian == '90ngay') {
                    var text = '90 Ngày';
                } else {
                    var text = '365 Ngày';
                }
                $('#text-date').text(text);
                $.ajax({
                    url: '{{ route('Admin.thongke') }}',
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        thoigian: thoigian
                    },
                    success: function(data) {

                        char.setData(data); // Đưa dữ liệu vào biểu đồ
                        $('#text-date').text(text);
                    }

                });

            })




            function thongke() {
                var text = '365 ngày';
                $('#text-date').text(text);
                $.ajax({
                    url: '{{ route('Admin.thongke') }}',
                    method: "POST",
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data); // Kiểm tra dữ liệu trả về từ server
                        char.setData(data); // Đưa dữ liệu vào biểu đồ
                    }

                });
            }
        });
    </script>
@endsection
