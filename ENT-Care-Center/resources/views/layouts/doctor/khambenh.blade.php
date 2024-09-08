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
    <main class="container mt-4">
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

        <div class="row" style="margin-top: -20px; margin-bottom: 5px">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h4 style="margin-top: 5px">Thông Tin Bệnh Nhân</h4>
                    </div>
                    <div class="card-body">
                        <div style="text-align: center">
                            <img class="rounded-circle"
                                style="width: 150px; height: 150px; margin-top:5px; margin-bottom: 10px"
                                src="{{ asset('uploads/avtkhachhang/' . $benhnhan->CUS_Avatar) }} ">
                        </div>

                        <br>
                        <div class="row mb-3 text-center">
                            <div class="col-md-6">
                                <label><strong>Tên Bệnh Nhân:</strong></label>
                                <p>{{ $benhnhan->CUS_Name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Ngày Sinh:</strong></label>
                                <p>{{ date('d-m-Y', strtotime($benhnhan->CUS_Birthday)) }}</p>
                            </div>
                        </div>
                        <div class="row mb-3 text-center">
                            <div class="col-md-6">
                                <label><strong>Số Điện Thoại:</strong></label>
                                <p>{{ $benhnhan->CUS_Phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Bác Sĩ Khám:</strong></label>
                                <p>{{ $benhnhan->LH_BSkham }}</p>
                            </div>
                        </div>
                        <div class="row mb-3 text-center">
                            <div class="col-md-6">
                                <label><strong>Giờ Khám:</strong></label>
                                <p>{{ $benhnhan->LH_Giokham }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Ngày Khám:</strong></label>
                                <p>{{ date('d-m-Y', strtotime($benhnhan->LH_Ngaykham)) }}</p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>



            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-secondary text-white text-center">
                        <h4 style="margin-top: 5px">Nhập Bệnh Án & Kê Đơn Thuốc</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('User.postbenhandonthuoc') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_lh" value="{{ $benhnhan->LH_Id }}">
                            <input type="hidden" name="ten" value="{{ $benhnhan->CUS_Name }}">

                            <div class="form-group mb-3">
                                <label for="chuandoan"><strong>Chẩn Đoán:</strong></label>
                                <textarea class="form-control" name="chuandoan" id="chuandoan" rows="1" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="huyetap"><strong>Huyết Áp:</strong></label>
                                    <input type="text" class="form-control" id="huyetap" name="huyetap" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="nhiptim"><strong>Nhịp Tim:</strong></label>
                                    <input type="text" class="form-control" id="nhiptim" name="nhiptim" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="nhietdo"><strong>Nhiệt Độ:</strong></label>
                                    <input type="text" class="form-control" id="nhietdo" name="nhietdo" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="ghichu"><strong>Ghi Chú:</strong></label>
                                <textarea class="form-control" name="ghichu" id="ghichu" rows="2"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="thuoc"><strong>Kê Đơn Thuốc:</strong></label>
                                <div id="thuoc-list">
                                    <div class="row" style="margin-top: 5px; margin-bottom: 5px">
                                        <div class="col-md-3">

                                            <select class="form-select" name="tenthuoc[]" required>
                                                <option required selected> Tên Thuốc </option>
                                                <option value="ví dụ">ví dụ</option>
                                                {{-- @foreach ($bacsitruc as $bs)
                                        <option value="{{ $bs->lt_tenbs }}">{{ $bs->lt_tenbs }}</option>
                                    @endforeach --}}
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <select class="form-select" name="lieuluong[]" placeholder="Liều Lượng"
                                                required>
                                                <option required selected> Liều Lượng </option>
                                                <option value="Ngày 1 lần">Ngày 1 lần</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <select class="form-select" name="cachsd[]" placeholder="Cách Dùng" required>
                                                <option required selected> Cách Dùng </option>
                                                <option value="Uống trước khi ăn">Uống trước khi ăn</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button"
                                                class="btn btn-danger btn-mg remove-medicine">Xóa</button>
                                            </select>

                                        </div>
                                    </div>

                                </div>
                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-success" id="add-medicine"
                                        style="margin-top:-10px; margin-bottom:-14px">Thêm Thuốc</button>
                                </div>
                            </div>
                            <div class="text-center mt-4" style=" margin-bottom:8px">
                                <button type="submit" class="btn btn-secondary"
                                    style="margin-top:-5px; margin-bottom:-10px">Lưu Bệnh Án & Kê Đơn</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <br>

    <script>
        document.getElementById('add-medicine').addEventListener('click', function() {
            var thuocList = document.getElementById('thuoc-list');
            var newMedicine = `
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select class="form-select" name="tenthuoc[]" required>
                            <option required selected>Tên Thuốc</option>
                            <option value="Thuốc A">Thuốc A</option>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" name="lieuluong[]" required>
                            <option required selected>Liều Lượng</option>
                            <option value="Ngày 2 lần">Ngày 2 lần</option>
                            {{-- Thêm các liều lượng khác --}}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" name="cachsd[]" required>
                            <option required selected>Cách Dùng</option>
                            <option value="Uống trước khi ăn">Uống trước khi ăn</option>
                            {{-- Thêm các cách dùng khác --}}
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-mg remove-medicine">Xóa</button>
                        </select>

                    </div>

                </div>
            `;

            // Thêm vào danh sách
            thuocList.insertAdjacentHTML('beforeend', newMedicine);

        });
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-medicine')) {
                event.target.closest('.row').remove(); // Xóa hàng thuốc chứa nút "Xóa"
            }

        });
    </script>
@endsection

@section('css')
@endsection
