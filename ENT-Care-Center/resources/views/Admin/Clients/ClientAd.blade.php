<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style type="text/css">
        @yield('css')
    </style>
</head>

<body style="font-family: Times New Roman, Times, serif;">

    <div class="container-fluid" style="background-color:rgb(234, 235, 239)">

        @yield('content')


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <script type="text/javascript">
        new Morris.Area({
            // ID của phần tử để vẽ biểu đồ.
            element: 'chart',
            // Dữ liệu biểu đồ -- mỗi mục trong mảng này tương ứng với một điểm trên biểu đồ.
            data: [{
                    year: '2008',
                    Nam: 10,
                    Nu: 5,
                    Soluong: 15
                }, {
                    year: '2009',
                    Nam: 33,
                    Nu: 7,
                    Soluong: 40
                },
                {
                    year: '2010',
                    Nam: 15,
                    Nu: 4,
                    Soluong: 19
                }, {
                    year: '2011',
                    Nam: 90,
                    Nu: 40,
                    Soluong: 130
                }
            ],
            // Tên của thuộc tính dữ liệu chứa giá trị x.
            xkey: 'year',
            // Danh sách tên của các thuộc tính dữ liệu chứa giá trị y.
            ykeys: ['Nam', 'Nu', 'Soluong'],
            // Nhãn cho các ykeys -- sẽ được hiển thị khi bạn di chuột qua biểu đồ.
            labels: ['Nam', 'Nữ', 'Tổng Số lượng']
        });
    </script>


</body>

</html>