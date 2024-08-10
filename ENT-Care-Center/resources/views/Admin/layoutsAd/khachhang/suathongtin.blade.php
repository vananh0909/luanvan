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
                SỬA THÔNG TIN BỆNH NHÂN
            </h1>

        </div>
        @if (session('status'))
            <h4 style="width: 750px; height:30px; margin: 0 auto;font-size:20px; text-align:center; padding-bottom:40px"
                class="alert alert-success">
                {{ session('status') }}</h4>
        @endif


        <form method="POST" action="{{ route('Admin.editthongtin', ['id' => $kh->CUS_Id]) }}" enctype="multipart/form-data">
            @csrf
            <table class="table table-striped" style="width: 50%; margin: 0 auto; ">

                <tbody>
                    <tr>
                        <th scope="row">Ảnh</th>
                        <td><input type="file" name="CUS_Avatar" class="form-control">
                            <img src="{{ asset('uploads/avtkhachhang/' . $kh->CUS_Avatar) }} "
                                style="width:70px; height: 70px">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tên Khách Hàng</th>
                        <td><input type="text" name="CUS_Name" class="form-control" value="{{ $kh->CUS_Name }}" required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Ngày Sinh</th>
                        <td><input type="date" name="CUS_Birthday" class="form-control"
                                value="{{ date('Y-m-d', strtotime($kh->CUS_Birthday)) }}" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Giới Tính</th>
                        <td>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="CUS_Gender" value="Nam"
                                    {{ $kh->CUS_Gender == 'Nam' ? 'checked' : '' }}> Nam
                            </label>
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="CUS_Gender" value="Nữ"
                                    {{ $kh->CUS_Gender == 'Nữ' ? 'checked' : '' }}> Nữ
                            </label>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Địa Chỉ</th>
                        <td><input type="text" name="CUS_Address" class="form-control" value="{{ $kh->CUS_Address }}"
                                required></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><input type="email" name="CUS_Email" class="form-control" value="{{ $kh->CUS_Email }}"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">SĐT</th>
                        <td><input type="text" name="CUS_Phone" class="form-control"
                                value="{{ $kh->CUS_Phone }}"required></td>
                    </tr>
                    <tr>
                        <th scope="row">Ngân Hàng</th>
                        <td><input type="text" name="CUS_Nganhang" class="form-control" value="{{ $kh->CUS_Nganhang }}"
                                required></td>
                    </tr>
                    <tr>
                        <th scope="row">Số Tài Khoản</th>
                        <td><input type="text" name="CUS_Stk" class="form-control" value="{{ $kh->CUS_Stk }}" required>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"></th>
                        <td><a class="btn btn-light"href="{{ route('Admin.quanlybenhnhan') }}"
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
