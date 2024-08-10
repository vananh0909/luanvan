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
            <select id="select-date" class="form-select" aria-label="Default select example"
                style="width:200px; text-align:center">
                <option selected>Thống Kê Theo</option>
                <option value="7day">7 Ngày</option>
                <option value="30day">30 Ngày</option>
                <option value="365day">365 Ngày</option>
            </select>
        </div>
        <div id="chart" style="height: 500px; margin-top:60px"></div>
        <div id="text-data"></div> <!-- Thêm phần hiển thị văn bản cho thông tin thống kê -->
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    {{-- <script type="text/javascript">
        $('#select-date').change(function() {
            var selectedValue = $(this).val();
            var text = '';
            if (selectedValue === '7day') {
                text = '7 ngày qua';
            } else if (selectedValue === '30day') {
                text = '30 ngày qua';
            } else if (selectedValue === '365day') {
                text = '365 ngày qua';
            }

            $.ajax({
                url: "{{ route('Admin.thongke') }}",
                method: "GET",
                dataType: "json",
                data: {
                    selectedValue: selectedValue
                },
                success: function(response) {
                    var data = response.data;
                    var chartText = response.text;

                    // Khởi tạo biểu đồ MorrisJS với dữ liệu nhận được
                    new Morris.Area({
                        element: 'chart',
                        data: data,
                        resize: true,
                        colors: ['#4e73df', '#1cc88a',
                            '#36b9cc'
                        ], // Màu sắc cho nam, nữ và tổng số lượng
                        formatter: function(y) {
                            return y + ' người'; // Định dạng dữ liệu trên biểu đồ
                        }
                    });

                    $('#text-data').text(chartText);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });
    </script> --}}
@endsection
