<div style="margin-top: 100px; " class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 240px">
                    ĐĂNG KÝ TÀI KHOẢN
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form style="margin: 0 auto" method="POST" action="{{ route('User.dangky') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div style="padding-top: 14px;">

                        <div style="width: 250px; float: left; margin-left: 60px; text-align:left">
                            <label for="name" style="margin: 2px">Tên (<span style="color:red">*</span>)</label>
                            <input id="name" class="form-control" type="text"
                                aria-label=".form-control-lg example" name="CUS_Name" required maxlength="100">
                        </div>
                        <div style="width: 250px; float: right;text-align:left; margin-right: 60px; ">
                            <label for="inputPassword5" class="form-label">Mật Khẩu (<span
                                    style="color:red">*</span>)</label>
                            <div class="input-group" style="margin-top: -4px">
                                <input type="password" id="inputPassword6" class="form-control"
                                    aria-describedby="passwordHelpBlock" name="CUS_PASS" required maxlength="8">
                                <button type="button" id="togglePassword1" class="btn btn-light"><i id="eyeIcon"
                                        class="fa-regular fa-eye"></i></button>
                            </div>
                            <script>
                                document.getElementById('togglePassword1').addEventListener('click', function() {
                                    var passwordInput = document.getElementById('inputPassword6');
                                    var passwordButton = document.getElementById('togglePassword1');
                                    var eyeIcon = document.getElementById('eyeIcon');

                                    if (passwordInput.type === "password") {
                                        passwordInput.type = "text";
                                        eyeIcon.className = "fa-solid fa-eye-slash";
                                    } else {
                                        passwordInput.type = "password";
                                        eyeIcon.className = "fa-regular fa-eye";
                                    }
                                });
                            </script>

                        </div>

                        <div style="width: 250px; float: left; margin-left: 60px; text-align:left">
                            <label for="nganhang" style="margin-top: 4px">Ngày Sinh (<span
                                    style="color:red">*</span>)</label>
                            <input id="nganhang" class="form-control" type="date"
                                aria-label=".form-control-lg example" name="CUS_Birthday" required>
                        </div>


                        <div style="width: 250px; float: right; margin-right: 60px; text-align:left">
                            <label for="sotaikhoan" style="margin-top: 4px">Ảnh Đại Diện (<span
                                    style="color:red">*</span>)</label>
                            <input class="form-control" type="file" aria-label=".form-control-lg example"
                                name="CUS_Avatar" required>

                        </div>



                        <div style="float: left; margin-left: 60px; text-align:left">
                            <div style="display: inline-block; text-align: left;">
                                <label
                                    for="gioitinh"style="display: inline-block; vertical-align: top; margin-top: 6px ">Giới
                                    Tính:</label>

                                <div style="display: inline-block;  margin-top: 38px; vertical-align: top;"
                                    class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CUS_Gender" id="inlineRadio1"
                                        value="Nam">
                                    <label class="form-check-label" for="inlineRadio1">🧒🏻 Nam</label>
                                </div>

                                <div style="display: inline-block; margin-top: 38px;vertical-align: top;"
                                    class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="CUS_Gender" id="inlineRadio2"
                                        value="Nữ">
                                    <label class="form-check-label" for="inlineRadio2">👩🏻 Nữ</label>
                                </div>
                            </div>
                        </div>




                        <div style="width:  250px; float: right; margin-right: 60px;text-align:left;margin-top:0.8px">
                            <label for="sdt" style="margin-top: 4px">Số Điện Thoại (<span
                                    style="color:red">*</span>)</label></label>
                            <input id="sdt" class="form-control" type="text"
                                aria-label=".form-control-lg example" name="CUS_Phone" required>
                        </div>
                        <div style="width: 250px; float: left; margin-left: 60px;text-align:left; margin-top:2.4px">
                            <label for="email" style="margin-top: 4px">Email: (<span
                                    style="color:red">*</span>)</label></label>
                            <input id="email" class="form-control" type="email"
                                aria-label=".form-control-lg example" name="CUS_Email" required>
                        </div>

                        <div style="width: 250px; float: right; margin-right: 60px; text-align:left">
                            <label for="dc" style="margin-top: 4px">Địa Chỉ (<span
                                    style="color:red">*</span>)</label>
                            <input id="dc" class="form-control" type="text"
                                aria-label=".form-control-lg example" name="CUS_Address" required>
                        </div>




                        <div style="width: 250px; float: left; margin-left: 60px; text-align:left">
                            <label for="nganhang" style="margin-top: 4px">Ngân Hàng</label>
                            <select class="form-select" aria-label="Default select example" name="CUS_Nganhang">
                                <option selected>Ngân Hàng</option>
                                <option value="Agribank">Agribank</option>
                                <option value="Sacombank">Sacombank</option>
                                <option value="MB Bank">MB Bank</option>
                            </select>
                            <br>
                        </div>


                        <div style="width: 250px; float: right; margin-right: 60px; text-align:left; ">
                            <label for="sotaikhoan" style="margin-top: 4px">Số Tài Khoản:</label>
                            <input id="sotaikhoan" class="form-control" type="text"
                                aria-label=".form-control-lg example" name="CUS_Stk">
                            <br>
                        </div>



                        <div style="text-align: center; padding-top: 34px">
                            <button id="tbao" type="submit" class="btn btn-info">Đăng Ký</button>
                            <br>
                            <br>
                        </div>




                    </div>
                    @if (session('status'))
                        <div style="padding-top:60px">
                            <h4 style="width: 300px; height:10px; margin: 0 auto;font-size:18px; text-align:center; padding-bottom:40px;"
                                class="alert alert-success">
                                {{ session('status') }}
                            </h4>
                        </div>
                    @elseif (session('error'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: "ĐĂNG KÝ THẤT BẠI ❌",
                                    text: "{{ session('error') }}",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            });
                        </script>
                    @endif

                </form>


            </div>
        </div>
    </div>
</div>
