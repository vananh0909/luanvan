@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div>
        <header>
            @include('layouts.doctor.headerdoctor')
        </header>

        <main style="font-family: Times New Roman, Times, serif;">
            <div class="container-fluid" style="background-color:rgb(234, 235, 239);width:64%">
                <div class="container">
                    <div class="card" style="margin-top:-16px;margin-bottom: 20px;">
                        <h1 style="color:rgb(86, 86, 86); font-size:20px;">
                            <img style="width:60px;margin-bottom:8px" src="{{ asset('images/img-nen/logo.png') }}"
                                alt="Logo">
                            ENT CARE CENTER

                        </h1>
                        <div style="text-align: center">
                            <h5 style="font-weight:bold; margin-top: 10px; font-size: 20px">ĐƠN THUỐC</h5>
                        </div>
                        <hr style="width:50%; margin:0 auto">
                        <div class="card-body" style="margin-top: 10px">

                            <div class="mb-3">
                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        <p><strong>Tên:</strong> {{ $donthuoc->CUS_Name }}</p>
                                        <p><strong>Ngày sinh:</strong>
                                            {{ date('d-m-Y', strtotime($donthuoc->CUS_Birthday)) }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Số điện thoại:</strong> {{ $donthuoc->CUS_Phone }}</p>
                                        <p><strong>Địa chỉ:</strong> {{ $donthuoc->CUS_Address }}</p>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;">
                                    <p><strong>Thời gian khám:</strong>
                                        {{ date('d-m-Y H:i:s', strtotime($donthuoc->created_at)) }}</p>
                                    <p><strong>Bác sĩ khám:</strong> {{ $user->name }}</p>
                                </div>
                            </div>


                        </div>

                        <!-- Thông tin bác sĩ -->
                        <div class="mb-3" style=" margin-left: 14px">
                            <p><strong>Chuẩn đoán:</strong> {{ $donthuoc->chuandoan }}</p>
                        </div>

                        <!-- Đơn thuốc -->
                        <div>
                            <h5 style="margin-left: 14px; font-weight:bold; font-size: 16px">Đơn thuốc</h5>
                            <table class="table table-bordered" style="width:96%; margin: 0 auto">
                                <thead>
                                    <tr>
                                        <th>Tên thuốc</th>
                                        <th>Số lượng</th>
                                        <th>Liều lượng</th>
                                        <th>Hướng dẫn sử dụng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $tenthuocArray = explode(',', $donthuoc->tenthuoc);
                                        $soluongArray = explode(',', $donthuoc->soluong);
                                        $lieuLuongArray = explode(',', $donthuoc->lieuluong);
                                        $cachSdArray = explode(',', $donthuoc->cachsd);
                                    @endphp

                                    @foreach ($tenthuocArray as $index => $tenthuoc)
                                        <tr>
                                            <td>{{ trim($tenthuoc) }}</td>
                                            <td>{{ isset($soluongArray[$index]) ? trim($soluongArray[$index]) : 'N/A' }}
                                            </td>
                                            <td>{{ isset($lieuLuongArray[$index]) ? trim($lieuLuongArray[$index]) : 'N/A' }}
                                            </td>
                                            <td>{{ isset($cachSdArray[$index]) ? trim($cachSdArray[$index]) : 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <table class="table table-bordered" style="width:96%; margin: 0 auto;">
                                    <tbody>
                                        @if (!empty($donthuoc->dichvukham))
                                            <tr>
                                                <td style="width: 30%;"><strong>Dịch vụ khám:</strong></td>
                                                <td style="text-align:right;">{{ $donthuoc->dichvukham }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td style="width: 30%;"><strong>Tổng tiền:</strong></td>
                                            <td style="text-align:right;font-weight:bold">{{ $donthuoc->tonggia }} đ</td>

                                        </tr>


                                    </tbody>
                                </table>
                            </table>

                        </div>
                        <div>
                            <div style="margin-top:10px; margin-bottom: 40px">
                                <h5 style="margin-left: 14px;font-size: 14px; font-weight:bold; ">Lời dặn bác
                                    sĩ: </h5>
                            </div>

                            <div style="float:right; margin-right: 40px; margin-top: 10px; ">
                                <p><strong>Ngày</strong> {{ now()->format('d') }}, <strong>Tháng</strong>
                                    {{ now()->format('m') }}, <strong>Năm</strong> {{ now()->format('Y') }}</p>

                                <!-- Thông tin đơn thuốc -->

                                <div class="signature-section" style="margin-left: 46px">
                                    <p><strong>Chữ ký bác sĩ:</strong></p>
                                    <p style="margin-top: 50px;margin-left:-14px">{{ $user->name }}</p>

                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ route('User.khambenh', ['id' => $donthuoc->LH_Id]) }}" class="btn btn-secondary"
                                style="width: 100px; margin-right:4px">Trở về</a>
                            <button class="btn btn-primary" onclick="window.print()">In đơn thuốc</button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
@endsection

@section('css')
    @media print {
    /* Đặt lề trang nhỏ hơn */
    @page {
    margin: 0.5in;
    }

    /* Ẩn header, footer, và các phần tử không cần thiết khi in */
    header, footer, .btn, .card-body hr {
    display: none;
    }

    /* Điều chỉnh chiều rộng nội dung cho bản in */
    .container-fluid {
    width: 100% !important;
    background-color: white !important;
    overflow: hidden; /* Đảm bảo không có phần tử tràn ra ngoài */
    zoom: 95%; /* Thu nhỏ nội dung nếu cần */
    }

    /* Điều chỉnh font chữ, căn lề cho đẹp */
    body {
    font-size: 14pt;
    line-height: 1.2;
    }

    /* Điều chỉnh lại margin và padding của các thành phần */
    .card {
    margin: 0 !important;
    padding: 10px; /* Thay đổi padding nếu cần */
    border: none;
    }

    /* Đảm bảo bảng thuốc in rõ ràng, không tràn ra ngoài */
    table {
    width: 100%;
    border-collapse: collapse;
    }

    th, td {
    padding: 5px; /* Giảm padding để tiết kiệm không gian */
    border: 1px solid black;
    font-size: 12pt; /* Điều chỉnh kích thước chữ trong bảng */
    }

    /* Ngăn ngắt trang trong các phần tử quan trọng */
    .no-page-break {
    page-break-inside: avoid;
    }
    }
    </style>
@endsection
