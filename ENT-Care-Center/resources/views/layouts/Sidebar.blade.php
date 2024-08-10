{{-- cài đặt --}}
<div style="text-align: center; font-size:26px; margin-top:20px">
    <a style="color:#757575;" href="{{ route('User.Setting') }}">
        <i id="sidebar" class="fas fa-user-cog"></i>
    </a>
    <hr>
</div>

{{-- home --}}
<div style="text-align: center; font-size:30px; margin-top:30px">
    <a style="color:#757575;" href="{{ route('User.Home') }}">
        <i id="sidebar" class="fa-solid fa-house"></i> </a>

</div>

{{-- lịch khám --}}
<div style="text-align: center; font-size:30px; margin-top:30px">
    <a style="color:#757575;" href="{{ route('User.lichkham') }}"> <i id="sidebar"
            class="fa-regular fa-calendar-check"></i> </a>

</div>

{{-- danh sách dịch vụ của hệ thống --}}
<div style="text-align: center; font-size:26px; margin-top:30px">
    <a style="color:#757575;" href="{{ route('User.dichvu') }}"> <i id="sidebar" class="fa-solid fa-list"></i> </a>
</div>


{{-- lịch sử khám --}}
<div style="text-align: center; color:#757575; font-size:26px; margin-top:30px">
    <a style="color:#757575;" href="{{ route('User.lichsukham') }}"> <i id="sidebar"
            class="fa-solid fa-clock-rotate-left"></i> </a>
</div>




<div style="text-align: center; color:#757575; font-size:26px; margin-top:290px">
    <hr>
    <form id="logout-form" action="{{ route('User.logout') }}" method="POST">
        @csrf
        <button type="submit"><i id="sidebar" class="fa-solid fa-right-from-bracket"></i></button>
    </form>


</div>
