@extends('Admin.Clients.ClientAd')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div style=" flex: 1;padding-left: 104px;">
        <header>
            @include('Admin.layoutsAd.HeaderAd')
        </header>
    </div>
    <main>
        <div>
            <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 20px; padding-bottom:20px">
                SỬA THÔNG TIN NHÂN VIÊN
            </h1>

        </div>
        @if (session('status'))
            <h4 style="width: 750px; height:30px; margin: 0 auto;font-size:20px; text-align:center; padding-bottom:40px"
                class="alert alert-success">
                {{ session('status') }}</h4>
        @endif


        <form method="POST" action="{{ route('Admin.editnhanvien', ['id' => $Nhanvien->NV_Id]) }}"
            enctype="multipart/form-data">
            @csrf
            <table class="table table-striped" style="width: 50%; margin: 0 auto; ">

                <tbody>
                    <tr>
                        <th scope="row">Ảnh</th>
                        <td><input type="file" name="NV_Avatar" class="form-control">
                            <img src="{{ asset('uploads/avtnhanvien/' . $Nhanvien->NV_Avatar) }} "
                                style="width:70px; height: 70px">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tên Nhân Viên</th>
                        <td><input type="text" name="NV_Ten" class="form-control" value="{{ $Nhanvien->NV_Ten }}"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Ngày Sinh</th>
                        <td><input type="date" name="NV_Birthday" class="form-control"
                                value="{{ date('Y-m-d', strtotime($Nhanvien->NV_Birthday)) }}" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Giới Tính</th>
                        <td>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="NV_Gioitinh" value="Nam"
                                    {{ $Nhanvien->NV_Gioitinh == 'Nam' ? 'checked' : '' }}> Nam
                            </label>
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="NV_Gioitinh" value="Nữ"
                                    {{ $Nhanvien->NV_Gioitinh == 'Nữ' ? 'checked' : '' }}> Nữ
                            </label>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Địa Chỉ</th>
                        <td><input type="text" name="NV_Diachi" class="form-control" value="{{ $Nhanvien->NV_Diachi }}"
                                required></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><input type="email" name="NV_Email" class="form-control" value="{{ $Nhanvien->NV_Email }}"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">SĐT</th>
                        <td><input type="text" name="NV_Sdt" class="form-control"
                                value="{{ $Nhanvien->NV_Sdt }}"required></td>
                    </tr>
                    <tr>
                        <th scope="row">Trình
                            Độ</th>
                        <td><input type="text" name="NV_Trinhdo" class="form-control"
                                value="{{ $Nhanvien->NV_Trinhdo }}" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Chức Vụ</th>
                        <td> <select class="form-select" aria-label="Default select example" name="NV_Chucvu" required>
                                <option selected>{{ $Nhanvien->NV_Chucvu }}</option>
                                @foreach ($chucvu as $cv)
                                    <option value="{{ $cv->name }}">{{ $cv->name }}</option>
                                @endforeach

                            </select></td>
                    </tr>
                    <tr>
                        <th scope="row">Giới Thiệu</th>
                        <td>
                            <textarea type="text" name="NV_Gioithieu" class="form-control" required>{{ $Nhanvien->NV_Gioithieu }}</textarea>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td><a class="btn btn-light"href="{{ route('Admin.quanlynhanvien', ['id' => $Nhanvien->NV_Id]) }}"
                                style="width: 134px; margin-left: 100px">Trở
                                Về</a>
                            <button type="submit" class="btn btn-primary" style="margin-left: 5px">Sửa Thông
                                Tin</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>

    </main>
    </div>



    </div>
@endsection


@section('css')
@endsection
