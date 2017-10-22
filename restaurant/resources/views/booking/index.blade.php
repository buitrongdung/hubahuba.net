@extends('layout.single2')
@section('content')
<!--chon combo-->
    @include ('order/block/header')
                        <div id=""><!--imformation-->
                            <div class="">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h1>Dịch vụ đặt bàn cho khách hàng</h1>
                                        <p class="clearfix">Dịch vụ đặt bàn trực tuyến giúp Quý khách thuận tiện hơn trong việc thưởng thức các món ăn. Tạo ra sự chuyên nghiệp mới mẻ!</p>
                                    </div>                                    
                                </div>
                                <h3>Dining experience desriptions</h3>
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col style="width: 25%">
                                        <col style="width: 25%">
                                        <col style="width: 25%">
                                        <col style="width: 25%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                        	@foreach($introduce as $intro)
                                            <th>{{$intro->name}}</th>
                                           	@endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                         	@foreach($introduce as $intro)
                                            <td style="vertical-align:middle">{{$intro->description}}</td>
                                           	@endforeach 
                                         </tr>
                                    </tbody>
                                </table>
                                <div class="start wow flipInX"  data-wow-duration="1s" data-wow-delay=".3s">
                                    <a href="{{url('booking/start')}}" class="hvr-bounce-to-bottom">Start booking</a>
                                </div>
                                <!--<form action="#" method="POST">
                                    <button class="btn btn-primary" href="{{url('booking/start')}}" name="start-booking">Start booking</button>
                                </form>-->
                            </div>
                        </div>                 
@stop