<?php
use App\Models\dv_dichvu2;
$thongtin = dv_dichvu2::orderBy('created_at', 'desc')->limit(4)->get();

?>
<iframe style="margin-left:2px; margin-top: 6px;margin-bottom: -10px"
    src="https://calendar.google.com/calendar/embed?height=280&wkst=1&ctz=Asia%2FHo_Chi_Minh&bgcolor=%23ffffff&showNav=0&showTitle=0&showPrint=0&showTabs=0&showTz=0&src=YW5oYjIwMTQ4MTRAc3R1ZGVudC5jdHUuZWR1LnZu&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21iYjE0NzY0ZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21iOGE3ZDViZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21mZmM4MWZhMEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20zNzhkYjBiZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21mNTUxOWY3OUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20xMTJjMjZkY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb201NmM0NWM3NUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21mNmJmYjVhMkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20yMzgwYTlhZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20zMzVlNjhjYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb202OTRkZGE0YkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb201MzcxZTQxNkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%2333B679&color=%23202124&color=%230047a8&color=%23007b83&color=%23137333&color=%230047a8&color=%230047a8&color=%23202124&color=%230047a8&color=%23202124&color=%230B8043&color=%23c26401&color=%230047a8&color=%23007b83&color=%23202124"
    width="330" height="230" frameborder="0" scrolling="no">
</iframe>
<hr>
<div style="margin-top: -5px">
    <p style="font-size:14px; color:rgb(86, 86, 86);font-weight:500">
        <i class="fa-solid fa-angles-right"></i>
        Có thể bạn quan tâm

    </p>

</div>
@foreach ($thongtin as $tt)
    <div class="alert alert-light d-flex align-items-center" id="right"
        style="box-shadow: 0 2px 4px rgba(105, 105, 105, 0.2); margin-bottom: 9px;">
        <img style="width: 42px; border-radius: 4px; margin-right: 10px;"
            src="{{ asset('uploads/dichvu/' . $tt->DV2_anhdv) }}">
        <div style="flex-grow: 1;">
            <a style="font-size: 16px; font-weight: 500;">{{ $tt->DV2_Tendv }}</a>
        </div>
    </div>
@endforeach




<div style="text-align: center; color:rgb(86, 86, 86); margin-top: -10px;">
    <i class="fa-solid fa-ellipsis"></i>
</div>

@section('css')
    #icon {
    text-align: center;
    width: 25px;
    height: 22px;
    border: 1px solid rgb(154, 153, 153);
    border-radius: 4px;
    padding-top: 2px;
    margin-left:4px;
    color:rgba(68, 158, 210, 0.8);
    }

    #icon:hover{
    box-shadow: 0 0 10px rgba(68, 158, 210, 0.8);
    cursor: pointer;
    color: red

    }

    .mxh {
    width: 40px;
    padding: 2px;
    border: 1px solid rgb(98, 98, 102);
    border-radius: 4px;
    color:rgba(68, 158, 210, 0.8);
    }

    .mxh:hover{
    box-shadow: 0 0 10px rgba(68, 158, 210, 0.8);
    cursor: pointer;

    }

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

    #right:hover{

    border: 2px solid rgb(213, 210, 210);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); /* Đổ bóng */

    }

    #dr:hover{

    border: 2px solid rgb(213, 210, 210);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); /* Đổ bóng */

    }

    #sidebar:hover{
    color:rgba(68, 158, 210, 0.8);
    cursor: pointer;

    }

    footer{
    background-color:green;
    }
@endsection
