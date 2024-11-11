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
        <main>

            <div class="container mt-5">
                <h2 style="text-align: center;">Chỉnh sửa Lịch Hẹn</h2>
                {{-- {{ route('User.updateLichHen', $lichhen->LH_Id) }} --}}
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="LH_Ngaykham">Ngày Khám</label>
                        <input type="date" class="form-control" id="LH_Ngaykham" name="LH_Ngaykham"
                            value="{{ $sualichhen->LH_Ngaykham }}" required>
                    </div>

                    <label for="LH_Ngaykham">Giờ Khám</label>
                    <select class="form-select" style="width: 300px; margin: 0 auto; padding: 6px" name="LH_Giokham"
                        required>

                        <option value="08:00" {{ $sualichhen->LH_Giokham == '08:00' ? 'selected' : '' }}>08:00</option>
                        <option value="08:30" {{ $sualichhen->LH_Giokham == '08:30' ? 'selected' : '' }}>08:30</option>
                        <option value="09:00" {{ $sualichhen->LH_Giokham == '09:00' ? 'selected' : '' }}>09:00</option>
                        <option value="09:30" {{ $sualichhen->LH_Giokham == '09:30' ? 'selected' : '' }}>09:30</option>
                        <option value="10:00" {{ $sualichhen->LH_Giokham == '10:00' ? 'selected' : '' }}>10:00</option>
                        <option value="10:30" {{ $sualichhen->LH_Giokham == '10:30' ? 'selected' : '' }}>10:30</option>
                        <option value="13:00" {{ $sualichhen->LH_Giokham == '13:00' ? 'selected' : '' }}>13:00</option>
                        <option value="13:30" {{ $sualichhen->LH_Giokham == '13:30' ? 'selected' : '' }}>13:30</option>
                        <option value="14:00" {{ $sualichhen->LH_Giokham == '14:00' ? 'selected' : '' }}>14:00</option>
                        <option value="14:30" {{ $sualichhen->LH_Giokham == '14:30' ? 'selected' : '' }}>14:30</option>
                        <option value="15:00" {{ $sualichhen->LH_Giokham == '15:00' ? 'selected' : '' }}>15:00</option>
                        <option value="15:30" {{ $sualichhen->LH_Giokham == '15:30' ? 'selected' : '' }}>15:30</option>
                        <option value="16:00" {{ $sualichhen->LH_Giokham == '16:00' ? 'selected' : '' }}>16:00</option>
                        <option value="16:30" {{ $sualichhen->LH_Giokham == '16:30' ? 'selected' : '' }}>16:30</option>
                    </select>

                    <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
                </form>
            </div>

        </main>
    </div>
@endsection

@section('css')
    .col-md-1 {
    margin-right: 34px;
    width: 65px;
    }
    .header {
    height: 60px;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    }
    .col-md-8 {
    width: 1000px;
    margin-right: 25px;
    border-radius: 6px;
    }
    footer {
    background-color: green;
    }
@endsection
