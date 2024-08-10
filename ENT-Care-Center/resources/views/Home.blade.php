@extends('Clients.Client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    {{-- <h1>Trang home nef</h1> --}}
    <div style=" background: linear-gradient(rgba(127, 168, 209, 0.3) ,rgba(68, 158, 210, 0.8)); height: 728px;
        position: fixed;  top: 0; left: 0; bottom: 0; "
        class="col-md-1">
        @include('layouts.Sidebar')
    </div>
    <div style=" flex: 1;padding-left: 104px;" class="col-md-11">
        <header>
            @include('layouts.Header')
        </header>
        <main>
            @include('layouts.Body')

        </main>
    </div>



    </div>
@endsection


@section('css')
    .col-md-1{
    margin-right:34px;
    width:65px;
    }

    .header{
    height:60px;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    }

    .col-md-8{
    width: 1000px;
    margin-right:25px;
    border-radius: 6px;

    }

    #dr:hover{

    border: 2px solid rgb(213, 210, 210);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); /* Đổ bóng */

    }


    footer{
    background-color:green;
    }
@endsection
