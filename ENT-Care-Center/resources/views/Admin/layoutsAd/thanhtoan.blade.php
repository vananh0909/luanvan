@extends('Admin.Clients.ClientAd')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <header>
        @include('Admin.layoutsAd.HeaderAd')
    </header>
    <main>

        @if (session('status'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Thành Công ✅",
                        text: "{{ session('status') }}",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @elseif (session('error'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Thất Bại ❌",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <form>
            <div class="form-group" style="padding-top: 10px; padding-bottom: 40px">
                <input type="text" name="search" id="search" style="width: 20%; " class="form-control"
                    placeholder="🔎 Tìm kiếm đơn thuốc...">
                <div id="suggestions"
                    style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10;">
                </div>
            </div>
        </form>

        <table class="table table-striped" style="width: 100%;margin: 0 auto">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Đơn Thuốc</th>
                    <th scope="col">Trạng Thái</th>


                    <th scope="col">Xem Đơn Thuốc</th>
                </tr>
            </thead>
            <tbody id="patient-list">
                @foreach ($thanhtoan as $tt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tt->id_donthuoc }} </td>
                        <td>
                            @if ($tt->trangthai == 'chưa thanh toán')
                                <form action=" {{ route('Admin.trangthai', $tt->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="">
                                        {{ $tt->trangthai }}
                                    </button>
                                </form>
                            @else
                                <button type="submit" class="btn btn-light" style="">
                                    {{ $tt->trangthai }}
                                </button>
                            @endif
                        </td>

                        <td>
                            <i style="margin-left:55px" id="icon" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $tt->id }}" class="fa-solid fa-pills"></i>

                            <div class="modal fade" id="modal-{{ $tt->id }}" tabindex="-1"
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
                                                    <td>{{ $tt->chuandoan ?? 'Chưa cập nhật' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Huyết Áp</th>
                                                    <td>{{ $tt->huyetap ?? 'N/A' }}/80</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Nhiệt Độ</th>
                                                    <td>{{ $tt->nhietdo ?? 'N/A' }}°C</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Nhịp Tim</th>
                                                    <td>{{ $tt->nhiptim ?? 'N/A' }} bpm</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Ghi Chú</th>
                                                    <td>{{ $tt->ghichu ?? 'Không có ghi chú' }}</td>
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
                                                        $tenthuocArray = explode(',', $tt->tenthuoc ?? '');
                                                        $soluongArray = explode(',', $tt->soluong ?? '');
                                                        $lieuluongArray = explode(',', $tt->lieuluong ?? '');
                                                        $cachsdArray = explode(',', $tt->cachsd ?? '');
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
                                                        <td>{{ $tt->dichvukham ?? 'Không có' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tổng tiền:</strong></td>
                                                        <td style="font-weight:bold">
                                                            {{ number_format($tt->tonggia ?? 0, 0, ',', '.') }} đ
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
        <br>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val().toLowerCase();

                // Nếu ô tìm kiếm rỗng, hiển thị lại tất cả các dòng
                if (query === '') {
                    $('#patient-list tr').show();
                    return;
                }

                // Lọc các dòng trong bảng
                $('#patient-list tr').filter(function() {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(query) > -
                        1); // Hiện hoặc ẩn dòng dựa trên kết quả tìm kiếm
                });
            });
        });
    </script>
@endsection

@section('css')
@endsection
