@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    {{-- <h1>Trang home nef</h1> --}}
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
                        <h1 style=" font-size: 24px; "> LỊCH SỬ LỊCH HẸN </h1>

                    </div>
                    @if (session('user'))
                        <div style="background-color: #ffffff; width: 1000px; border-radius:6px; margin:0 auto"
                            class="col-md-6">

                            <table class="table table-striped table-hover"
                                style=" width:98%; margin: 0 auto; font-weight:400;">
                                <thead>
                                    <tr style="color: rgba(68, 158, 210, 0.8);">
                                        <th scope="col">STT</th>
                                        <th scope="col">Ngày Khám</th>
                                        <th scope="col">Giờ khám</th>
                                        <th scope="col">Bác sĩ</th>
                                        <th scope="col">Triệu chứng</th>
                                        <th scope="col">Hành động</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lichhen as $ls)
                                        <tr>

                                            <th style="color: rgba(68, 158, 210, 0.8);" scope="row">1</th>
                                            <th scope="col">{{ date('d-m-Y', strtotime($ls->LH_Ngaykham)) }}</th>
                                            <th scope="col">{{ $ls->LH_Giokham }}</th>
                                            <th scope="col">{{ $ls->LH_BSkham }}</th>
                                            <th scope="col">{{ $ls->LH_trieuchung }}</th>

                                            <td>
                                                <i id="icon" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    class="fa-solid fa-pills"></i>
                                                @include('layouts.modal')
                                                {{-- <i id="icon" class="fa-solid fa-pen"></i>
                                                <i id="icon" class="fa-solid fa-trash-can"></i> --}}
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                            <br>
                        </div>
                    @else
                        <div style="background-color:rgb(234, 235, 239); width: 1000px; height: 580px; border-radius:6px; margin:0 auto;border: 1px solid rgb(154, 153, 153);"
                            class="col-md-6">
                            <h1 style="text-align: center; padding-top: 240px; font-size: 22px;  color:rgb(86, 86, 86);">
                                KHÔNG CÓ LỊCH SỬ ĐỂ HIỂN THỊ</h1>
                        </div>
                    @endif
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
    {{-- #icon {
    text-align: center;
    width: 25px;
    height: 22px;
    border: 1px solid rgb(154, 153, 153);
    border-radius: 4px;
    padding-top: 2px;
    } --}}


    {{-- .col-md-1{
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
    } --}}
@endsection
