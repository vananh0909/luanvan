<div
    style="position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 96%; z-index: 1000; background-color: #ffffff; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
    <ul class="nav justify-content-center"
        style="max-width: 2000px; height: 50px; padding-top:8px; color:rgb(86, 86, 86); margin: 0;">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('User.lichhen') }}" style="color:rgb(86, 86, 86);">DANH SÁCH LỊCH HẸN</a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('User.dklichtruc') }}" style="color:rgb(86, 86, 86);"> ĐĂNG KÝ LỊCH
                TRỰC</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('User.xemlichtrucbs') }}" style="color:rgb(86, 86, 86);"> LỊCH TRỰC</a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('User.lichsukhambs') }}" style="color:rgb(86, 86, 86);"> LỊCH SỬ
                KHÁM</a>
        </li>

    </ul>
</div>
@if (Auth::check())
    <div
        style="display: flex; justify-content: flex-end; color:#757575; padding-top: 70px;  margin-bottom: 10px; margin-right:20px">
        <a href="{{ route('User.trangcanhan') }}"
            class="btn btn-light"style="padding-left: 135px; padding-right: 135px;font-weight:bold; font-size:18px">Bs:
            {{ Auth::user()->name }}</a>
    </div>
@endif

<div
    style="display: flex; justify-content: flex-end; color:#757575; margin-top:8px;  margin-bottom: 32px; margin-right:20px">

    <form id="logout-form" action="{{ route('User.logout') }}" method="POST" style="margin: 4px;">
        @csrf
        <button class="btn btn-light" type="submit">Đăng Xuất <i class="fas fa-sign-out-alt"></i></button>
    </form>
</div>
