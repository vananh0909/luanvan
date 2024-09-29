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
            style="background-color: rgb(243, 244, 247); margin-top: 30px; width: 350px; height: 450px; overflow-y: auto; border-radius: 6px; padding: 0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; box-sizing: border-box;">


            <div class="header"
                style="background-color: white; padding: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <div class="user-info" style="display: flex; align-items: center; justify-content: flex-start;">
                    <img src="https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474029WAz/anh-meo-cute-hinh-meo-ngau-de-thuong-3.jpg"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                    <div>
                        <h1 style="margin: 0; font-size: 16px;">Vân Anh</h1>
                        <p style="margin: 0; font-size: 12px; color: gray;">Đang hoạt động</p>
                    </div>
                </div>

            </div>

            <!-- Phần body -->
            <div class="body"
                style="display: flex; flex-direction: column; background-color: #f9f9f9; padding: 10px; height: 350px; overflow-y: auto;">
                <div class="message"
                    style="background-color: white; padding: 8px; border-radius: 15px; margin-bottom: 10px; max-width: 70%;box-shadow: 0 1px 2px rgba(115, 114, 114, 0.2); align-self: flex-start;">
                    <p style="margin: 0; font-size: 13px;">hế lô</p>
                </div>
                <div class="message"
                    style="background-color: rgba(68, 158, 210, 0.8); padding: 8px; border-radius: 15px; margin-bottom: 10px; max-width: 70%;box-shadow: 0 1px 2px rgba(115, 114, 114, 0.2); align-self: flex-end;">
                    <p style="margin: 0; font-size: 13px;"> J tường chóaa 🐕</p>
                </div>
                <div class="message"
                    style="background-color: white; padding: 8px; border-radius: 15px; margin-bottom: 10px; max-width: 70%;box-shadow: 0 1px 2px rgba(115, 114, 114, 0.2); align-self: flex-start;">
                    <p style="margin: 0; font-size: 13px;">J tường đáng gécccccccccccc</p>
                </div>
                <div class="message"
                    style="background-color:rgba(68, 158, 210, 0.8); padding: 8px; border-radius: 15px; margin-bottom: 10px; max-width: 70%;box-shadow: 0 1px 2px rgba(115, 114, 114, 0.2); align-self: flex-end;">
                    <p style="margin: 0; font-size: 13px;"> J tường chóaaaaaaaaaaaaaaaaa 🐕</p>
                </div>
                <div class="message"
                    style="background-color: rgba(68, 158, 210, 0.8);  padding: 8px; border-radius: 15px; margin-bottom: 10px; max-width: 70%;box-shadow: 0 1px 2px rgba(115, 114, 114, 0.2); align-self: flex-end;">
                    <p style="margin: 0; font-size: 13px;"> hihi 🐕</p>
                </div>
            </div>

            <!-- Phần footer -->
            <div class="footer" style="background-color: white; padding: 10px;position: relative; width: 100%;">
                <div style="position: relative; width: 100%;">
                    <input type="text" name="search" id="search" class="form-control"
                        style="font-size:12px; padding-right: 60px; height: 30px;" placeholder="Nhập nội dung ở đây...">

                    <button type="button"
                        style=" font-size:12px;position: absolute; right: 0; top: 0; height: 100%; border: none; background-color: gray; color: white; padding: 0 15px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; cursor: pointer;">
                        <i class="fas fa-paper-plane" style="color:#f9f9f9"></i>
                    </button>
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
