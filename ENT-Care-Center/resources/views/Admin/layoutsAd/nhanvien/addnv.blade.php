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
                THÊM NHÂN VIÊN
            </h1>

        </div>
        @if (session('status'))
            <h4 style="width: 750px; height:30px; margin: 0 auto;font-size:20px; text-align:center; padding-bottom:40px"
                class="alert alert-success">
                {{ session('status') }}</h4>
        @endif


        <form method="POST" action="{{ route('Admin.postnhanvien') }}" enctype="multipart/form-data">
            @csrf
            <table class="table table-striped" style="width: 50%; margin: 0 auto; ">

                <tbody>
                    <tr>
                        <th scope="row">Ảnh</th>
                        <td><input type="file" name="NV_Avatar" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Tên Nhân Viên</th>
                        <td><input type="text" name="NV_Ten" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Ngày Sinh</th>
                        <td><input type="date" name="NV_Birthday" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Giới Tính</th>
                        <td>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="NV_Gioitinh" value="Nam"> Nam
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="NV_Gioitinh" value="Nữ"> Nữ
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Địa Chỉ</th>
                        <td><input type="text" name="NV_Diachi" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><input type="email" name="NV_Email" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">SĐT</th>
                        <td><input type="text" name="NV_Sdt" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Trình Độ</th>
                        <td><input type="text" name="NV_Trinhdo" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Chức Vụ</th>

                        <td>
                            <select class="form-select" aria-label="Default select example" name="NV_Chucvu" required>
                                <option selected>Chức Vụ</option>
                                @foreach ($chucvu as $cv)
                                    <option value="{{ $cv->name }}">{{ $cv->name }}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Giới Thiệu</th>
                        <td>
                            <textarea type="text" name="NV_Gioithieu" class="form-control" required></textarea>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td><a class="btn btn-light"href="{{ route('Admin.quanlynhanvien') }}"
                                style="width: 134px; margin-left: 100px">Trở
                                Về</a>
                            <button type="submit" class="btn btn-primary" style="margin-left: 5px">Thêm Nhân
                                Viên</button>
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
