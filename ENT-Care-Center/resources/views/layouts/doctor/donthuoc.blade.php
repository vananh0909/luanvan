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
                        <div style="text-align: center">
                            <h5 style="font-weight:bold; margin-top: 10px">Đơn Thuốc</h5>
                        </div>
                        <hr style="width:98%; margin:0 auto">
                        <div class="card-body">

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
                            <h5 style="margin-left: 14px; font-weight:bold">Đơn thuốc</h5>
                            <table class="table table-bordered" style="width:96%; margin: 0 auto">
                                <thead>
                                    <tr>
                                        <th>Tên thuốc</th>
                                        <th>Liều lượng</th>
                                        <th>Hướng dẫn sử dụng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $tenthuocArray = explode(',', $donthuoc->tenthuoc);
                                        $lieuLuongArray = explode(',', $donthuoc->lieuluong);
                                        $cachSdArray = explode(',', $donthuoc->cachsd);
                                    @endphp

                                    @foreach ($tenthuocArray as $index => $tenthuoc)
                                        <tr>
                                            <td>{{ trim($tenthuoc) }}</td>
                                            <td>{{ isset($lieuLuongArray[$index]) ? trim($lieuLuongArray[$index]) : 'N/A' }}
                                            </td>
                                            <td>{{ isset($cachSdArray[$index]) ? trim($cachSdArray[$index]) : 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Nút in đơn thuốc -->
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
@endsection
