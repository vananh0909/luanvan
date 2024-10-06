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


        <form action="{{ route('Admin.postsuathuoc', ['id' => $suathuoc->id_thuoc]) }}" method="POST"
            style="width: 50%; margin: 0 auto">
            @csrf
            <div class="form-group ">
                <label for="ten-thuoc" style="font-weight:bold; margin-bottom:4px">Tên Thuốc: </label>
                <input type="text" class="form-control" id="tenthuoc" name="tenthuoc" value="{{ $suathuoc->tenthuoc }}"
                    required>
            </div>
            <label for="tenthuoc" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Chọn Loại Thuốc: </label>
            <select class="form-control" id="tenloai" name="id_loai" required>
                <option value="">{{ $suathuoc->ten_loai }}</option>
                @foreach ($loaithuoc as $thuoc)
                    <option value="{{ $thuoc->id_loai }}">{{ $thuoc->ten_loai }}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label for="soluong" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Số Lượng: </label>
                <input type="number" class="form-control" id="soluong" name="soluong" value="{{ $suathuoc->soluong }}"
                    required>
            </div>
            <div class="form-group">
                <label for="donvi" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Đơn Vị: </label>
                <input type="text" class="form-control" id="donvi" name="donvi" value="{{ $suathuoc->donvi }}"
                    required>
            </div>
            <div class="form-group">
                <label for="giathuoc" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Giá Thuốc (VNĐ): </label>
                <input type="number" class="form-control" id="giathuoc" name="giathuoc" value="{{ $suathuoc->giathuoc }}"
                    step="0.01" required>
            </div>

            <div class="form-group">
                <label for="donvi" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Liều Lượng: </label>
                <input type="text" class="form-control" id="lieuluong" name="lieuluong"
                    value="{{ $suathuoc->lieuluong }}" required>
            </div>
            <div class="form-group">
                <label for="giathuoc" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Cách Dùng: </label>
                <input type="text" class="form-control" id="cachdung" name="cachdung" value="{{ $suathuoc->cachdung }}"
                    required>
            </div>

            <div class="form-group">
                <label for="mota" style="font-weight:bold;margin-bottom:4px; margin-top:4px">Mô Tả: </label>
                <textarea class="form-control" id="mota" name="mota" rows="3">{{ $suathuoc->mota }}</textarea>
            </div>
            <br>
            <div class="text-center mt-3">
                <a href="{{ route('Admin.khothuoc') }}" class="btn btn-secondary" style="margin-right:4px; width:80px">Trở
                    về</a>
                <button type="submit" class="btn btn-primary" style=" width:100px">Cập nhật</button>

            </div>
        </form>
        <br>
    </main>
    <br>
    <br>
    <br>
    <br>
@endsection

@section('css')
@endsection
