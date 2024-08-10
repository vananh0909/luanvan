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
                THÊM DỊCH VỤ
            </h1>

        </div>
        @if (session('status'))
            <h4 style="width: 750px; height:30px; margin: 0 auto;font-size:20px; text-align:center; padding-bottom:40px"
                class="alert alert-success">
                {{ session('status') }}</h4>
        @endif


        <form method="POST" action="{{ route('Admin.postdichvu1') }}" enctype="multipart/form-data">
            @csrf
            <table class="table table-striped" style="width: 50%; margin: 0 auto; ">

                <tbody>

                    <tr>
                        <th scope="row">Tên Dịch Vụ</th>
                        <td><input type="text" name="DV_Tendv" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Giá Dịch Vụ</th>
                        <td><input type="text" name="DV_Gia" class="form-control" required></td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td><a class="btn btn-light"href="{{ route('Admin.quanlydichvu') }}"
                                style="width: 134px; margin-left: 100px">
                                Trở Về</a>
                            <button type="submit" class="btn btn-primary" style="margin-left: 5px">Thêm Dịch Vụ</button>
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
