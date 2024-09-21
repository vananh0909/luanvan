@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div style="background: linear-gradient(rgba(127, 168, 209, 0.3), rgba(68, 158, 210, 0.8)); height: 728px; position: fixed; top: 0; left: 0; bottom: 0;"
        class="col-md-1">
        @include('layouts.Sidebar')
    </div>
    <div style="flex: 1; padding-left: 104px;" class="col-md-11">
        <header>
            @include('layouts.Header')
        </header>
        <main>
            <div class="row">
                <div class="col-md-8" style="background-color:rgb(234, 235, 239); margin-left: 6px">
                    <div style="text-align:center; margin-top: 6px; padding-bottom: 8px">
                        <h1 style="font-size: 24px;"> LỊCH SỬ KHÁM </h1>
                    </div>

                    @if (session('user') && $lichhen->isNotEmpty())
                        <div style="background-color: #ffffff; width: 1000px; border-radius:6px; margin:0 auto"
                            class="col-md-6">
                            <table class="table table-striped table-hover"
                                style="width:98%; margin: 0 auto; font-weight:400;">
                                <thead>
                                    <tr style="color: rgba(68, 158, 210, 0.8);">
                                        <th scope="col">STT</th>
                                        <th scope="col">Ngày Khám</th>
                                        <th scope="col">Giờ khám</th>
                                        <th scope="col">Bác sĩ</th>
                                        <th scope="col">Triệu chứng</th>
                                        <th scope="col">Bệnh án & Đơn thuốc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lichhen as $index => $ls)
                                        <tr>
                                            <th style="color: rgba(68, 158, 210, 0.8);" scope="row">{{ $index + 1 }}
                                            </th>
                                            <th scope="col">{{ date('d-m-Y', strtotime($ls->LH_Ngaykham)) }}</th>
                                            <th scope="col">{{ $ls->LH_Giokham }}</th>
                                            <th scope="col">{{ $ls->LH_BSkham }}</th>
                                            <th scope="col">{{ $ls->LH_trieuchung }}</th>
                                            <td>
                                                <i style="margin-left:55px" id="icon" data-bs-toggle="modal"
                                                    data-bs-target="#modal-{{ $index }}"
                                                    class="fa-solid fa-pills"></i>
                                                <div class="modal fade" id="modal-{{ $index }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="text-center text-primary">Thông Tin Bệnh Án</h5>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th scope="col">Chuẩn Đoán</th>
                                                                        <td>{{ $ls->chuandoan ?? 'Chưa cập nhật' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="col">Huyết Áp</th>
                                                                        <td>{{ $ls->huyetap ?? 'N/A' }}/80</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="col">Nhiệt Độ</th>
                                                                        <td>{{ $ls->nhietdo ?? 'N/A' }}°C</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="col">Nhịp Tim</th>
                                                                        <td>{{ $ls->nhiptim ?? 'N/A' }} bpm</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="col">Ghi Chú</th>
                                                                        <td>{{ $ls->ghichu ?? 'Không có ghi chú' }}</td>
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
                                                                            $tenthuocArray = explode(
                                                                                ',',
                                                                                $ls->tenthuoc ?? '',
                                                                            );
                                                                            $soluongArray = explode(
                                                                                ',',
                                                                                $ls->soluong ?? '',
                                                                            );
                                                                            $lieuluongArray = explode(
                                                                                ',',
                                                                                $ls->lieuluong ?? '',
                                                                            );
                                                                            $cachsdArray = explode(
                                                                                ',',
                                                                                $ls->cachsd ?? '',
                                                                            );
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
                                                                            <td>{{ $ls->dichvukham ?? 'Không có' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Tổng tiền:</strong></td>
                                                                            <td style="font-weight:bold">
                                                                                {{ $ls->tonggia ?? 0 }} đ</td>
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

                <div class="col-md-3" style="background-color:#ffff; margin-left: 9px; height: 647px">
                    @include('layouts.Right')
                </div>
            </div>
        </main>
    </div>
@endsection
