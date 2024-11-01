@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div>
        <header>
            @include('layouts.doctor.headerdoctor')
        </header>
    </div>
    <main style="font-family: Times New Roman, Times, serif;">


        <div style="margin-bottom: 10px; margin-left: 54px">
            <a href="{{ route('User.khambenh', ['id' => $firstLhId]) }}" class="btn btn-light">
                <i class="fas fa-backward" style="font-size: 20px; "></i>
            </a>

        </div>

        <div class="container-fluid" style="background-color:rgb(234, 235, 239)">
            @if (Auth::check() && $benhan)
                <div style="background-color: #ffffff; width: 1400px; border-radius:6px; margin:0 auto" class="col-md-6">

                    <table class="table table-striped table-hover" style=" width:99%; margin: 0 auto; font-weight:400;">
                        <thead>
                            <tr style="color: rgba(68, 158, 210, 0.8); font-weight:bold">
                                <th scope="col">STT</th>
                                <th scope="col">Bệnh nhân</th>
                                <th scope="col">Ngày Khám</th>
                                <th scope="col">Giờ khám</th>
                                <th scope="col">Triệu chứng</th>
                                <th scope="col">Bệnh án & Đơn thuốc</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($benhan as $index => $ba)
                                <tr>
                                    <th style="color: rgba(68, 158, 210, 0.8);" scope="row">
                                        {{ $index + 1 }}
                                    </th>
                                    <th scope="col">{{ $ba->CUS_Name }}</th>
                                    <th scope="col">{{ date('d-m-Y', strtotime($ba->LH_Ngaykham)) }}</th>
                                    <th scope="col">{{ $ba->LH_Giokham }}</th>

                                    <th scope="col">{{ $ba->LH_trieuchung }}</th>

                                    <td>
                                        <i style="margin-left:55px" id="icon" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $index }}" class="fa-solid fa-pills"></i>

                                        <div class="modal fade" id="modal-{{ $index }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="text-center text-primary">Thông Tin Bệnh Án</h5>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th scope="col">Chuẩn Đoán</th>
                                                                <td>{{ $ba->chuandoan }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Huyết Áp</th>
                                                                <td>{{ $ba->huyetap }}/80</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Nhiệt Độ</th>
                                                                <td>{{ $ba->nhietdo }}°C</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Nhịp Tim</th>
                                                                <td>{{ $ba->nhiptim }} bpm</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Ghi Chú</th>
                                                                <td>{{ $ba->ghichu ?? 'Không có ghi chú' }}</td>
                                                            </tr>
                                                        </table>

                                                        <h5 class="text-center text-primary mb-3">Đơn Thuốc</h5>
                                                        <table class="table table-bordered border-primary">
                                                            <thead class="bg-primary text-white">
                                                                <tr>
                                                                    <th scope="col">STT</th>
                                                                    <th scope="col">Tên Thuốc</th>
                                                                    <th scope="col">Số Lượng</th>
                                                                    <th scope="col">Liều Lượng</th>
                                                                    <th scope="col">Cách sử dụng</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $tenthuocArray = explode(',', $ba->tenthuoc);
                                                                    $soluongArray = explode(',', $ba->soluong);
                                                                    $lieuluongArray = explode(',', $ba->lieuluong);
                                                                    $cachsdArray = explode(',', $ba->cachsd);
                                                                @endphp

                                                                @foreach ($tenthuocArray as $i => $tenthuoc)
                                                                    <tr>
                                                                        <th scope="row">{{ $i + 1 }}</th>
                                                                        <td>{{ trim($tenthuoc) }}</td>
                                                                        <td>{{ isset($soluongArray[$i]) ? trim($soluongArray[$i]) : 'N/A' }}
                                                                        </td>
                                                                        <td>{{ isset($lieuluongArray[$i]) ? trim($lieuluongArray[$i]) : 'N/A' }}
                                                                        </td>
                                                                        <td>{{ isset($cachsdArray[$i]) ? trim($cachsdArray[$i]) : 'N/A' }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Dịch vụ khám:</strong></td>
                                                                    <td>{{ $ba->dichvukham }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Tổng tiền:</strong></td>
                                                                    <td style="font-weight:bold">
                                                                        {{ number_format($ba->tonggia ?? 0, 0, ',', '.') }}
                                                                        đ
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>


                </div>
                <br>
                <br>
                <br>

                <br>
                <br>
            @else
                <div style="background-color:rgb(234, 235, 239); width: 1000px; height: 580px; border-radius:6px; margin:0 auto;border: 1px solid rgb(154, 153, 153);"
                    class="col-md-6">
                    <h1 style="text-align: center; padding-top: 240px; font-size: 22px;  color:rgb(86, 86, 86);">
                        NGƯỜI DÙNG CHƯA CÓ BỆNH ÁN</h1>
                </div>
            @endif
        </div>



    </main>






@endsection




@section('css')
    #icon{
    border: 2px solid rgba(68, 158, 210, 0.8);
    padding: 4px;
    color: rgba(68, 158, 210, 0.8);
    cursor: pointer;
    }
    #icon:hover{

    color: red;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Đổ bóng */

    }
@endsection
