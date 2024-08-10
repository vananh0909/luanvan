@if (session('user'))
    <div style="width: 500px; padding: 15px; color:black">
        <h1 style="font-size: 18px">Dear {{ session('user')['CUS_Name'] }},</h1>
        @if ($lichhen)
            <p style="font-size: 16px; font-family: Times New Roman, Times, serif; text-align: justify; color: black">
                Bạn đã đặt lịch khám thành công.

            </p>
            <p style="font-size: 16px; font-family: Times New Roman, Times, serif; text-align: justify; color: black">
                Lịch hẹn khám vào lúc {{ $lichhen[0]->LH_Giokham }} giờ ngày
                {{ date('d-m-Y', strtotime($lichhen[0]->LH_Ngaykham)) }}</p>

            <p style="font-size: 16px; font-family: Times New Roman, Times, serif; text-align: justify; color: black">Xin
                vui lòng đến đúng ngày giờ đã hẹn
            </p>
            <br>
            <p>
                Xin cảm ơn !</p>
        @endif
    </div>
@endif
