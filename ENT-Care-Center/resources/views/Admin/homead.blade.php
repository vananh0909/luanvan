@extends('Admin.Clients.ClientAd')


@section('content')
    <div style=" flex: 1;padding-left: 104px;" class="col-md-11">
        <header>
            @include('Admin.layoutsAd.HeaderAd')
        </header>
        <main>
            @include('Admin.auth.LoginAuth')

        </main>
    </div>



    </div>
@endsection
