@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div style=" background: linear-gradient(rgba(127, 168, 209, 0.3) ,rgba(68, 158, 210, 0.8)); height: 728px;
        position: fixed;  top: 0; left: 0; bottom: 0; "
        class="col-md-1">
        @include('layouts.Sidebar')
    </div>
    <div style=" flex: 1;padding-left: 104px;" class="col-md-11">
        <header>
            @include('layouts.Header')
        </header>
        <main>

            <div class="row">
                <div class="col-md-8" style="background-color:rgb(234, 235, 239); margin-left: 6px">
                    <div style="text-align:center; margin-top: 6px; padding-bottom: 8px">
                        <h1 style=" font-size: 22px; "> GÓI DỊCH VỤ</h1>

                    </div>


                    <div style="background-color: #ffffff; width: 1000px; border-radius:6px; margin:0 auto" class="col-md-6">
                        <div style=" width:95%; margin: 0 auto">

                            <p style="padding-top:14px; font-weight:500; font-style:italic; text-align: justify;">
                                Phòng khám Tai Mũi Họng ENT Care Center cung cấp các dịch vụ chăm
                                sóc sức khỏe đảm bảo chất lượng và tối ưu chi phí cho Khách hàng và Doanh nghiệp. Các gói
                                dịch
                                vụ và chi phí dịch vụ có thể được chỉnh sửa nhằm phù hợp với từng nhu cầu cụ thể của các đối
                                tượng Khách hàng. </p>

                        </div>

                        <table class="table table-striped table-hover" style=" width:95%; margin: 0 auto; font-weight:500;">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">TÊN DỊCH VỤ</th>
                                    <th scope="col">ĐƠN GIÁ</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Dichvu1 as $dv)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dv->DV_Tendv }} </td>
                                        <td> {{ $dv->DV_Gia }}</td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                        <br>
                        <br>
                        <hr style="width:99%; margin:0 auto">
                        <br>
                        <div style=" margin-left:8px; margin-bottom: 20px; padding-top: 8px">




                            @foreach ($Dichvu2 as $dv2)
                                <div style="margin-top: 8px; display: inline-block; padding-bottom: 50px ">
                                    <div style="width: 200px; float: left; position: relative; margin-right:10px">
                                        <img style="width: 200px; border-radius:6px; "
                                            src="{{ asset('uploads/dichvu/' . $dv2->DV2_anhdv) }}">

                                    </div>

                                    <a
                                        style="float: right; margin-right: 420px;  font-size:20px ; margin-bottom: 10px; font-weight:500">
                                        {{ $dv2->DV2_Tendv }}
                                    </a>
                                    <br>

                                    <div
                                        style=" padding: 10px; margin-left: 10px;margin-top: 12px; font-size: 16px; text-align: justify;  ">
                                        <p>
                                            {{ $dv2->DV2_gioithieu }}
                                        </p>
                                    </div>

                                </div>
                            @endforeach
                            <hr style="margin-right: 6px">




                        </div>


                    </div>


                </div>
                <div class="col-md-3"
                    style="background-color:#ffffff; width:356px; border-radius: 6px;margin-left:16px;margin-bottom:6px;height:642px;">
                    @include('layouts.Right')
                </div>
            </div>


        </main>


    </div>



    </div>
@endsection




@section('css')
    .col-md-1{
    margin-right:34px;
    width:65px;
    }

    .header{
    height:60px;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    }

    .col-md-8{
    width: 1000px;
    margin-right:25px;
    border-radius: 6px;

    }

    footer{
    background-color:green;
    }
@endsection
