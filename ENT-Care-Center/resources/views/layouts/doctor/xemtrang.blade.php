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

    <main style="font-family: Times New Roman, Times, serif;height:520px;">

        <div class="container-fluid"
            style="margin-top:52px;max-width: 600px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding-top: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h4 class="text-center mb-4" style="font-weight: bold;">Thông Tin Bác Sĩ</h4>

            <!-- Thông tin bác sĩ -->
            <div class="row mb-3" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                <div class="col-sm-4" style="font-weight: bold;">Tên bác sĩ:</div>
                <div class="col-sm-8">{{ $users->name }}</div>
            </div>

            <div class="row mb-3" style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                <div class="col-sm-4" style="font-weight: bold;">Số điện thoại:</div>
                <div class="col-sm-8">{{ $users->phone }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4" style="font-weight: bold;">Email:</div>
                <div class="col-sm-8">{{ $users->email }}</div>
            </div>

        </div>
        <div style="text-align:center; margin-top: 18px">
            <a href="{{ route('User.bacsi') }}" class="btn btn-secondary " style="width:100px; margin-right:4px">Trở về</a>
            <a href="{{ route('User.suathongtin', ['id' => $users->id]) }}"
                class="btn btn-primary "style="width:100px">Sửa</a>
        </div>




        <br>

        <br>

    </main>
@endsection




@section('css')
@endsection
