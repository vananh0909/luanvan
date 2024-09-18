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


        <div class="container-fluid" style="background-color:rgb(234, 235, 239);height:525px">
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


            <form action="{{ route('User.postsuathongtin', ['id' => $users->id]) }}" method="POST"
                style="width: 35%; margin: 0 auto; padding-top:58px">
                @csrf
                <div class="form-group ">
                    <label for="name" style="font-weight:bold; margin-bottom:4px">Tên bác sĩ: </label>
                    <input type="text" class="form-control" id="tenthuoc" name="name" value="{{ $users->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="phone" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Số điện thoại:
                    </label>
                    <input type="text" class="form-control" id="soluong" name="phone" value="{{ $users->phone }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="email" style="font-weight:bold; margin-bottom:4px; margin-top:4px">Email: </label>
                    <input type="text" class="form-control" id="donvi" name="email" value="{{ $users->email }}"
                        required>
                </div>

                <br>
                <div class="text-center mt-3">
                    <a href="{{ route('User.trangcanhan') }}" class="btn btn-secondary"
                        style="margin-right:4px; width:100px">Trở
                        về</a>
                    <button type="submit" class="btn btn-primary" style=" width:100px">Cập nhật</button>

                </div>
            </form>
            <br>
        </div>
        </div>
    </main>


    </div>



    </div>
@endsection




@section('css')
@endsection
