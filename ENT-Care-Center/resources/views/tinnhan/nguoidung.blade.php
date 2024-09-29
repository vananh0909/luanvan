<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">


    <style type="text/css">
        @yield('css')
    </style>
</head>


<body style="font-family: Times New Roman, Times, serif;">


    <div class="container-fluid"style="background-color:rgb(234, 235, 239)">

        <div class="row">
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

            @yield('content')

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">


        <style>
            .container {
                background-color: rgb(234, 235, 239);
                width: 80%;
                max-width: 400px;
                height: 60vh;
                max-height: 600px;
                overflow-y: auto;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: width 0.3s ease, height 0.3s ease;
                /* Thêm hiệu ứng chuyển đổi mềm mại */
            }

            @media (max-width: 768px) {
                .container {
                    width: 90%;
                    /* Tăng chiều rộng lên để chiếm nhiều không gian hơn trên màn hình nhỏ */
                    height: 50vh;
                    /* Giảm chiều cao để phù hợp với các màn hình nhỏ hơn */
                }
            }

            @media (max-width: 480px) {
                .container {
                    width: 95%;
                    /* Gần như chiếm toàn bộ chiều rộng của màn hình */
                    height: 40vh;
                    /* Giảm chiều cao để vừa với màn hình điện thoại */
                }
            }
        </style>
    </head>


    <body style="font-family: Times New Roman, Times, serif;">


        <div class="container"
            style="background-color:rgb(243, 244, 247);;margin-top: 30px; width: 350px; height: 450px; overflow-y: auto; border-radius: 6px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="user-info" style="display: flex; align-items: center; justify-content:  flex-start;">
                <img src="https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474029WAz/anh-meo-cute-hinh-meo-ngau-de-thuong-3.jpg"
                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">

                <div>
                    <h1 style="margin: 0; font-size: 16px;">Vân Anh</h1>
                    <p style="margin: 0; font-size: 12px; color: gray;">Đang hoạt động</p>
                </div>
            </div>
            <hr>
            <form>

                <div style="position: relative; width: 100%;">
                    <input type="text" name="search" id="search" class="form-control"
                        style="font-size:12px; padding-right: 60px; height: 30px;" placeholder="🔎 Nhập tên để tìm">

                    <button type="button"
                        style=" font-size:12px;position: absolute; right: 0; top: 0; height: 100%; border: none; background-color: gray; color: white; padding: 0 15px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; cursor: pointer;">
                        Tìm
                    </button>


                    {{-- <div id="suggestions"
                        style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10;">
                    </div> --}}
                </div>
            </form>
            <div style="margin-top: 8px">



                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                    <div class="user-info" style="display: flex; align-items: center;">
                        <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2024/02/avatar-anh-meo-cute-5.jpg"
                            style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                        <div>
                            <h1 style="margin: 0; font-size: 14px;">J. Tường</h1>
                            <p style="margin: 0; font-size: 12.5px; color: gray;">hế lô </p>
                        </div>
                    </div>
                    <i class="fa-solid fa-circle" style="color: green; font-size:10px"></i>
                </div>



                <hr style="margin: 4px; padding: 0; border: 1px solid rgba(0, 0, 0, 0.2);">

                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                    <div class="user-info" style="display: flex; align-items: center;">
                        <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2024/02/avatar-anh-meo-cute-5.jpg"
                            style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                        <div>
                            <h1 style="margin: 0; font-size: 14px;">J. Tường</h1>
                            <p style="margin: 0; font-size: 12.5px; color: gray;">pé iuu</p>
                        </div>
                    </div>
                    <i class="fa-solid fa-circle" style="color: green; font-size:10px"></i>
                </div>


            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

</body>

</html>
