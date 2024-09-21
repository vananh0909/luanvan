<header>
    <div style="background-color:#ffffff;  width:100%; max-width:1384px; " class="header">
        <div class="row" style="margin-left:20px;">
            <div class="col-md-4">
                <h1 style="color:rgb(86, 86, 86); font-size:20px;">
                    <img style="width:60px;margin-bottom:8px" src="{{ asset('images/img-nen/logo.png') }}" alt="Logo">
                    ENT CARE CENTER

                </h1>
            </div>
            <div class="col-md-7" style="margin-left: 110px; ">
                <div style="margin-top:12px; width:300px; float: right;" class="d-flex">
                    <form style="margin-top:4px;margin-left: 100px;" class="d-flex">
                        @if (session('user'))
                            <div style="display: flex; align-items: center; margin-right: 6px;">
                                <div style="margin-right: 6px;">
                                    <img style="width: 40px; height: 40px; border-radius: 4px;"
                                        src="{{ asset('uploads/avtkhachhang/' . session('user')->CUS_Avatar) }}"
                                        alt="Avatar">
                                </div>
                                <div style="margin-left: 14px; flex-grow: 1;">
                                    <p
                                        style="font-size: 16px; color: rgb(106, 105, 105); font-weight: bold; margin: 0; white-space: nowrap;">
                                        {{ session('user')->CUS_Name }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div>
                                <p
                                    style="font-size:15px; color:rgb(106, 105, 105); font-weight:400; margin-left:80px; margin-right:10px;margin-top:8px; text-decoration: underline;">
                                    <a href="{{ route('User.dangnhap') }}">Đăng Nhập</a>
                                </p>
                            </div>
                            <div>
                                <p style="font-size: 22px;margin-top:-2px;color:rgb(106, 105, 105); ">
                                    <i class="fa-solid fa-user"></i>
                                </p>
                            </div>
                        @endif

                    </form>


                    {{-- <div
                        style="width: 0.3px; height: 34px; background-color: rgb(212, 212, 212); float: right; margin-left:-100px; margin-top:6px; margin-right:6px">
                    </div> --}}

                </div>




            </div>
        </div>
    </div>
</header>
<br>
