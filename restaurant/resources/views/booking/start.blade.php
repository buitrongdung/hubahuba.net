@extends('layout.single2')
@section('content')
    <div class="container">
        @include ('block.flash')
        <div class="panel panel-primary" style="margin-top: 20px;height: 376px;">
            <div class="panel-heading">
                <h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Quy định đặt bàn</h1>
            </div>
            <form action="{{route('postStart')}}" method="post" class="form-horizontal">
                <fieldset>                       
                        <div class="panel-body" style="text-align: justify;">
                            <p class="wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s" style=" font-size:18px; font-family:'Merriweather Sans, sans-serif'">
                                Chào mừng bạn đến với hệ thống yêu cầu đặt bàn của nhà hàng. <br>
                                Trước khi xác nhận thông tin của xin vui lòng đọc và chấp nhận yêu cầu của nhà hàng. <br>
                           
                                - Quý khách phải có mặt trước 15 phút để xác nhận thông tin đặt bàn.</li>
                                Nếu quý khách đến trễ, bàn sẽ không được đảm bảo (vì vậy để không bị thiệt thòi bàn chuyển sang chế độ chờ khách).<br>
                                Ngoài việc quý khách đã đặt món ăn và đồ uống trên website của nhà hàng, Quý khách vẫn có thể thay đổi hoặc thêm món ăn ngay tại bàn ăn.<br>
                                <u>Quý khách lưu ý:</u> &nbsp;Về thông tin đặt bàn.<br>
                                - Nhà hàng sẽ gửi mail cho Quý khách để xác nhận thông tin đặt bàn. Quý khách cần xác nhận mail. Sau đó Quý khách có thể thay đổi hoặc hủy đặt bàn.<br>
                                - Trước ngày đặt bàn 1 ngày quý khách không được hủy bàn. Nếu hủy bàn Quý khách sẽ chịu 1 phần phí theo quy định của nhà hàng.<br>
                            </p>
                            <div class="checkbox" style="margin-top:10px">
                                <label>
                                    <input type="checkbox" id="agree" name="agree" > <b>Tôi đồng ý với các quy định của nhà hàng</b>
                                </label>
                            </div>

                        </div>                       
                </fieldset>
                <div style="margin-bottom:20px">
                    <button class="butselect hvr-bounce-to-bottom" name="agree-group" type="submit" 
                    style="background-color:#EFA52C; border:none;float: left;margin-left: 15px;width: 147px;margin-top: -3px;">Bắt đầu đặt bàn</button>
                </div>
            </form>
        </div>
    </div>
@stop