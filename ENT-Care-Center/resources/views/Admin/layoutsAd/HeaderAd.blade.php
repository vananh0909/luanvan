<div>
    <ul class="nav justify-content-center"
        style="width: 98%; max-width: 2000px; background-color: #ffffff; margin-left:-30px; height: 50px; padding-top:8px;color:rgb(86, 86, 86);">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('Admin.quanlylichhen') }}" style="color:rgb(86, 86, 86);">DANH SÁCH LỊCH
                HẸN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('Admin.quanlybenhnhan') }}" style="color:rgb(86, 86, 86);">QUẢN LÝ BỆNH
                NHÂN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('Admin.quanlybacsy') }}" style="color:rgb(86, 86, 86);">QUẢN LÝ BÁC
                SỸ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('Admin.quanlydichvu') }}" style="color:rgb(86, 86, 86);">QUẢN LÝ DỊCH
                VỤ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('Admin.quanlynhanvien') }}" style="color:rgb(86, 86, 86);">QUẢN LÝ NHÂN
                VIÊN</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('Admin.thongkebaocao') }}" style="color:rgb(86, 86, 86);">THỐNG KÊ </a>
        </li>
    </ul>
</div>
@if (Auth::check())
    <div
        style="display: flex; justify-content: flex-end; color:#757575; margin-top:8px;  margin-bottom: 10px; margin-right:54px">
        <a class="btn btn-light"style="padding-left: 135px; padding-right: 135px;">{{ Auth::user()->name }}</a>
    </div>
@endif

<div
    style="display: flex; justify-content: flex-end; color:#757575; margin-top:8px;  margin-bottom: 32px; margin-right:50px">
    @hasrole('admin')
        <a href="{{ route('alluser') }}" class="btn btn-light" style="margin: 4px;"> Phân Quyền <i
                class="fas fa-user"></i></a>
    @endhasrole
    <a href="{{ route('Admin.doctor') }}" class="btn btn-light" style="margin: 4px;"> Bác Sĩ <i
            class="fas fa-user-md"></i></a>

    <form id="logout-form" action="{{ route('logoutAuth') }}" method="POST" style="margin: 4px;">
        @csrf
        <button class="btn btn-light" type="submit">Đăng Xuất <i class="fas fa-sign-out-alt"></i></button>
    </form>
</div>
