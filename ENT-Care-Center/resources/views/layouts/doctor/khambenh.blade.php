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
    <a href="{{ route('User.lichhen') }}" style="padding-bottom:0px; margin-top: -14px"><i class="fas fa-backward"
            style="color:gray"></i></a>
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
        @if (!empty(session('warnings')))
            <div class="alert alert-warning alert-dismissible fade show" role="alert"
                style="padding-top: -40px; padding-bottom: 0px; margin-bottom: 20px;">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                    style="float: right; margin-top: -6px; font-size: 12px"></button>
                <ul style="list-style-type: none; font-weight: bold; color: rgb(245, 92, 92)">
                    @foreach (session('warnings') as $warning)
                        <li><i class="fa-solid fa-triangle-exclamation" style="color: red"></i> {{ $warning }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="row" style="margin-top: -10px; margin-bottom: 5px">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h4 style="margin-top: 5px">Thông Tin Bệnh Nhân</h4>
                    </div>
                    <div class="card-body text-center">
                        <img class="rounded-circle" style="width: 150px; height: 150px; margin: 5px 0;"
                            src="{{ asset('uploads/avtkhachhang/' . $benhnhan->CUS_Avatar) }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Tên Bệnh Nhân:</strong></label>
                                <p>{{ $benhnhan->CUS_Name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Ngày Sinh:</strong></label>
                                <p>{{ date('d-m-Y', strtotime($benhnhan->CUS_Birthday)) }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Số Điện Thoại:</strong></label>
                                <p>{{ $benhnhan->CUS_Phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Bác Sĩ Khám:</strong></label>
                                <p>{{ $benhnhan->LH_BSkham }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label><strong>Ngày Khám:</strong></label>
                                <p>{{ date('d-m-Y', strtotime($benhnhan->LH_Ngaykham)) }}</p>
                            </div>

                            <div class="col-md-6">
                                <label><strong>Giờ Khám:</strong></label>
                                <p>{{ $benhnhan->LH_Giokham }}</p>
                            </div>
                        </div>
                        <div style="margin-top: -16px">
                            <a href='{{ route('User.benhan', ['id' => $benhnhan->CUS_Id]) }}' class="btn btn-light"
                                style="margin-top: -14px">Bệnh án</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
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

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="dichvu"><strong>Dịch vụ:</strong></label>
                                    <select class="form-select" name="dichvukham" required>
                                        <option value="" disabled selected>Dịch vụ</option>
                                        @foreach ($dichvu as $dv)
                                            <option value="{{ $dv->DV_Tendv }}">{{ $dv->DV_Tendv }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="ghichu"><strong>Ghi Chú:</strong></label>
                                    <textarea class="form-control" name="ghichu" id="ghichu" rows="1"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="thuoc"><strong>Kê Đơn Thuốc:</strong></label>
                                <div id="thuoc-list">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <input type="text" name="tenthuoc[]" class="form-control search-thuoc"
                                                placeholder="Tên thuốc">
                                            <div class="suggestions"
                                                style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10; width: 23%;">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="soluong[]"
                                                placeholder="Số Lượng" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="lieuluong[]"
                                                class="form-control search-lieuluong" placeholder="Liều lượng">
                                            <div class="suggestions-lieuluong"
                                                style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10; width: 23%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="cachsd[]" class="form-control search-cachsd"
                                                placeholder="Cách dùng">
                                            <div class="suggestions-cachsd"
                                                style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10; width: 23%;">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button"
                                                class="btn btn-danger btn-mg remove-medicine">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-success" id="add-medicine">Thêm Thuốc</button>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-secondary">Lưu Bệnh Án & Kê Đơn</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('add-medicine').addEventListener('click', function() {
            var thuocList = document.getElementById('thuoc-list');

            var newMedicine = `
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" name="tenthuoc[]" class="form-control search-thuoc" placeholder="Tên thuốc">
                        <div class="suggestions" style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10; width: 23%;"></div>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="soluong[]" placeholder="Số Lượng" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="lieuluong[]" class="form-control search-lieuluong" placeholder="Liều lượng">
                        <div class="suggestions-lieuluong" style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10; width: 23%;"></div>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="cachsd[]" class="form-control search-cachsd" placeholder="Cách dùng">
                        <div class="suggestions-cachsd" style="border: 1px solid #ccc; display: none; position: absolute; background: white; z-index: 10; width: 23%;"></div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-mg remove-medicine">Xóa</button>
                    </div>
                </div>
            `;

            thuocList.insertAdjacentHTML('beforeend', newMedicine);
        });

        $(document).on('click', '.remove-medicine', function() {
            $(this).closest('.row').remove();
        });

        // Gợi ý cho tên thuốc
        $(document).on('keyup', '.search-thuoc', function() {
            var query = $(this).val().toLowerCase();
            var suggestionsDiv = $(this).siblings('.suggestions');
            suggestionsDiv.empty().hide();

            if (query) {
                @foreach ($khothuoc as $kt)
                    if ('{{ $kt->tenthuoc }}'.toLowerCase().includes(query)) {
                        suggestionsDiv.append(
                            '<div class="suggestion-item" style="cursor: pointer;">' +
                            '{{ $kt->tenthuoc }}' + '</div>'
                        );
                    }
                @endforeach
                suggestionsDiv.show();
            }
        });

        // Xử lý khi người dùng nhấp vào một gợi ý tên thuốc
        $(document).on('click', '.suggestion-item', function() {
            var input = $(this).closest('.suggestions').prev('.search-thuoc');
            input.val($(this).text());
            $(this).parent().hide();
        });

        // Gợi ý cho liều lượng
        $(document).on('keyup', '.search-lieuluong', function() {
            var query = $(this).val().toLowerCase();
            var suggestionsDiv = $(this).siblings('.suggestions-lieuluong');
            suggestionsDiv.empty().hide();

            if (query) {
                @foreach ($khothuoc as $kt)
                    if ('{{ $kt->lieuluong }}'.toLowerCase().includes(query)) {
                        suggestionsDiv.append(
                            '<div class="suggestion-item" style="cursor: pointer;">' +
                            '{{ $kt->lieuluong }}' + '</div>'
                        );
                    }
                @endforeach
                suggestionsDiv.show();
            }
        });

        // Xử lý khi người dùng nhấp vào một gợi ý liều lượng
        $(document).on('click', '.suggestions-lieuluong .suggestion-item', function() {
            var input = $(this).closest('.suggestions-lieuluong').prev('.search-lieuluong');
            input.val($(this).text());
            $(this).parent().hide();
        });

        // Gợi ý cho cách sử dụng
        $(document).on('keyup', '.search-cachsd', function() {
            var query = $(this).val().toLowerCase();
            var suggestionsDiv = $(this).siblings('.suggestions-cachsd');
            suggestionsDiv.empty().hide();

            if (query) {
                @foreach ($khothuoc as $kt)
                    if ('{{ $kt->cachdung }}'.toLowerCase().includes(query)) {
                        suggestionsDiv.append(
                            '<div class="suggestion-item" style="cursor: pointer;">' +
                            '{{ $kt->cachdung }}' + '</div>'
                        );
                    }
                @endforeach
                suggestionsDiv.show();
            }
        });

        // Xử lý khi người dùng nhấp vào một gợi ý cách sử dụng
        $(document).on('click', '.suggestions-cachsd .suggestion-item', function() {
            var input = $(this).closest('.suggestions-cachsd').prev('.search-cachsd');
            input.val($(this).text());
            $(this).parent().hide();
        });

        // Ẩn gợi ý khi nhấp bên ngoài
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.suggestions').length) {
                $('.suggestions').hide();
            }
            if (!$(event.target).closest('.suggestions-lieuluong').length) {
                $('.suggestions-lieuluong').hide();
            }
            if (!$(event.target).closest('.suggestions-cachsd').length) {
                $('.suggestions-cachsd').hide();
            }
        });
    </script>
@endsection
