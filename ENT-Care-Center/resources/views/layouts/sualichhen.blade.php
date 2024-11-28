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
            <div class="row">
                <div class="col-md-8" style="background-color: rgb(234, 235, 239); margin-left: 6px">


                    <div class="container mt-5 p-4"
                        style="max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                        <h2 class="text-center mb-4" style="color: #4455a8;">Chỉnh sửa Lịch Hẹn</h2>

                        <form action="{{ route('User.postsualichhen', $sualichhen->LH_Id) }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="LH_Ngaykham" class="form-label" style="font-weight: bold; color: #333;">Bác Sĩ
                                    Khám</label>
                                <select class="form-select" style=" margin: 0 auto; padding: 6px"
                                    aria-label="Default select example" name="LH_BSkham" required>
                                    @foreach ($bacsitruc as $bs)
                                        <option value="{{ $bs->lt_tenbs }}"
                                            {{ $bs->lt_tenbs == $sualichhen->LH_BSkham ? 'selected' : '' }}>
                                            {{ $bs->lt_tenbs }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group mb-3">
                                <label for="LH_Ngaykham" class="form-label" style="font-weight: bold; color: #333;">Ngày
                                    Khám</label>
                                <input type="date" class="form-control" id="LH_Ngaykham" name="LH_Ngaykham"
                                    value="{{ $sualichhen->LH_Ngaykham }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="LH_Giokham" style="font-weight: bold; color: #333;">Giờ Khám</label>
                                <select class="form-select" id="LH_Giokham" style=" margin: 0 auto; padding: 6px"
                                    name="LH_Giokham" required>
                                    <option value="08:00" {{ $sualichhen->LH_Giokham == '08:00' ? 'selected' : '' }}>08:00
                                    </option>
                                    <option value="08:30" {{ $sualichhen->LH_Giokham == '08:30' ? 'selected' : '' }}>08:30
                                    </option>
                                    <option value="09:00" {{ $sualichhen->LH_Giokham == '09:00' ? 'selected' : '' }}>09:00
                                    </option>
                                    <option value="09:30" {{ $sualichhen->LH_Giokham == '09:30' ? 'selected' : '' }}>09:30
                                    </option>
                                    <option value="10:00" {{ $sualichhen->LH_Giokham == '10:00' ? 'selected' : '' }}>10:00
                                    </option>
                                    <option value="10:30" {{ $sualichhen->LH_Giokham == '10:30' ? 'selected' : '' }}>10:30
                                    </option>
                                    <option value="13:00" {{ $sualichhen->LH_Giokham == '13:00' ? 'selected' : '' }}>13:00
                                    </option>
                                    <option value="13:30" {{ $sualichhen->LH_Giokham == '13:30' ? 'selected' : '' }}>13:30
                                    </option>
                                    <option value="14:00" {{ $sualichhen->LH_Giokham == '14:00' ? 'selected' : '' }}>14:00
                                    </option>
                                    <option value="14:30" {{ $sualichhen->LH_Giokham == '14:30' ? 'selected' : '' }}>14:30
                                    </option>
                                    <option value="15:00" {{ $sualichhen->LH_Giokham == '15:00' ? 'selected' : '' }}>15:00
                                    </option>
                                    <option value="15:30" {{ $sualichhen->LH_Giokham == '15:30' ? 'selected' : '' }}>15:30
                                    </option>
                                    <option value="16:00" {{ $sualichhen->LH_Giokham == '16:00' ? 'selected' : '' }}>16:00
                                    </option>
                                    <option value="16:30" {{ $sualichhen->LH_Giokham == '16:30' ? 'selected' : '' }}>16:30
                                    </option>
                                </select>

                            </div>
                            <div class="form-group mb-3">
                                <label for="LH_Email" class="form-label"
                                    style="font-weight: bold; color: #333;">Email</label>
                                <input type="text" class="form-control" id="LH_Email" name="LH_Email"
                                    value="{{ $sualichhen->LH_Email }}" required>
                            </div>


                            <div class="form-group mb-3">
                                <label for="LH_trieuchung" class="form-label" style="font-weight: bold; color: #333;">Triệu
                                    Chứng</label>
                                <input type="text" class="form-control" id="LH_chieutrung" name="LH_trieuchung"
                                    value="{{ $sualichhen->LH_trieuchung }}" required>
                            </div>


                            <div style="text-align: center">
                                <a href="{{ route('User.huylichhen') }}" class="btn btn-light "
                                    style=" border: none; margin-top: 6px">
                                    Trở Về
                                </a>
                                <button type="submit" class="btn btn-primary " style=" border: none; margin-top: 6px">
                                    Cập Nhật
                                </button>
                            </div>
                        </form>
                    </div>

                </div>



                <div class="col-md-3"
                    style="background-color: #ffffff; width: 356px; border-radius: 6px; margin-left: 16px; margin-bottom: 6px; height: 642px;">
                    @include('layouts.Right')
                </div>
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
