@extends('layout.single3')
@section('content')
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,400italic,600,600italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'> -->
  <!--   <link href="{{ asset('order/css/bootstrap.css') }}" rel="stylesheet">
 -->
  <link href="{{ asset('order/css/bootstrap-responsive.css') }}" rel="stylesheet">

  <!--   <link href="{{ asset('order/css/style.css') }}" rel="stylesheet">
 -->  <link href="{{ asset('order/css/flexslider.css') }}" type="text/css" media="screen" rel="stylesheet"  />
  <link href="{{ asset('order/css/jquery.fancybox.css') }}" rel="stylesheet">
  <link href="{{ asset('order/css/cloud-zoom.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('order/assets/ico/favicon.html') }}">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!-- fav -->


  <div class="container">
    <div class="panel panel-primary" style="margin-top: 20px">
      <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 37px;">Danh sách chọn các dịch vụ</h1>
      </div>
      <form method="POST" action="">
        <div class="cart-info">
          <table class="table table-striped table-bordered">
            <tr>
              <th class="image" style="text-align: center;">Hình ảnh</th>
              <th class="name" style="text-align: center;>">Tên chọn</th>
              <th class="quantity" style="text-align: center;">Số lượng</th>
              <th class="price" style="text-align: center;">Giá</th>
              <th colspan="2" class="total" style="text-align: center;">Tổng giá</th>
            </tr>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            @foreach ($content as $item)
              <tr class="invoice_item">
                <td class="image" style="width: 119px;">
                  <a href="#"><img title="product" src="{!!asset('images/menu/'.$item['options']['img'])!!}" height="50" width="100"></a>
                </td>
                <td class="name" style="text-align: center;"><a href="#">{{$item['name']}}</a></td>
                <td class="quantity" style="width: 137px;" >
                  <div id="result">
                    @if ($item['options']['id_type'] == 9)
                      <input name="qty" id="{{ $item->rowid}}" data-price="{{$item['price']}}" class="span1 qty" type="text" size="1" value="{{$item['qty']}}" name="quantity[40]" style="width: 60px;border-radius: 5px;text-align: center;" readonly/>
                    @else
                    <input name="qty" id="{{ $item->rowid}}" onblur="myFunction(this)" data-price="{{$item['price']}}" class="span1 qty" type="text" size="1" value="{{$item['qty']}}" name="quantity[40]" style="width: 60px;border-radius: 5px;text-align: center;"/>
                    @endif
                  </div>
                </td>
                <td class="price" id="price" name="price" style="text-align: center;">{!! number_format($item->price,0,".",".") !!} VNĐ</td>
                <td class="total" id="total" name="total" style="text-align: center;display: none;">{{ number_format($item->price*$item->qty,0,"","") }} VNĐ</td>
                <td class="a" id="a" name="a" style="text-align: center;">{{ number_format($item->price*$item->qty,0,".",".") }} VNĐ</td>
                <td class="total" style="width: 55px;">
                  <a href="{!!route('delete', ['id'=>$item['rowid']])!!}">
                    <img class="tooltip-test" data-original-title="Remove" src="{!!asset('order/img/remove.png')!!}" alt="">
                  </a>
                </td>
              </tr>
            @endforeach
          </table>

        </div>
        <div class="container" style="margin-left: -110px;">
          <div>
            @if(Auth::check())
              <div class="col-sm-6" style="margin-left: 108px;">
                <div class="total_area">
                  <ul>
                    <li style="display:block;">Họ tên: <span>{!! Auth::user()->name !!} </span></li>
                    <li style="display:block;">Số điện thoại: <span>{!! Auth::user()->phone !!}</span></li>
                    <li style="display:block;">Email: <span>{!! Auth::user()->email !!} </span></li>
                    <li style="display:block;">Địa chỉ: <span>{!! Auth::user()->address !!} </span></li>
                  </ul>
                </div>
              </div>
            @endif
          </div>
          <div class="pull-right">
            <div class="span3 pull-right" style="margin-right: -4px;">
              <table class="table table-striped table-bordered ">
                <tr>
                  <td><span class="extra bold totalamout">Thành tiền</span></td>
                  <td><span class="bold totalamout" id="totalAmount" name="totalAmount">{!! number_format($total,0,".",".") !!} VNĐ</span></td>
                </tr>
              </table>
            </div>
          </div>
          <div style="float: left;width: 1140px;margin-top: 16px;">
            <div class="butselect hvr-bounce-to-bottom" style="width: 206px;float: left;margin-left: 132px;">
              <div style="margin-top: 5px;">
                <a style="color: white;padding-left: 13px;" name="continue" value="" href="{{route('indexCart', ['id' => 1, 'alias' => 'khaivi'])}}<?=ARTICLE_SUFFIX?>"> Tiếp tục chọn thực đơn </a>
              </div>
            </div>
            <div class="butselect hvr-bounce-to-bottom">
              <div style="margin-top: 5px;">
                <a class="checkOut" href="{{route('xacNhanMuaHang')}}" style="color: white;padding-left: 13px;" onclick="return xacnhanxoa('Bạn muốn xác nhận hóa đơn này?')"> Xem đơn hàng</a>

              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- javascript
      ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="{{ url('order/js/jquery.js') }}"></script>
  <script src="{{ url('order/js/bootstrap.js') }}"></script>
  <script src="{{ url('order/js/respond.min.js') }}"></script>
  <script src="{{ url('order/js/application.js') }}"></script>
  <script src="{{ url('order/js/bootstrap-tooltip.js') }}"></script>
  <script defer src="{{ url('order/js/jquery.fancybox.js') }}"></script>
  <script defer src="{{ url('order/js/jquery.flexslider.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/jquery.tweet.js') }}"></script>
  <script src="{{ url('order/js/cloud-zoom.1.0.2.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/jquery.validate.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/jquery.carouFredSel-6.1.0-packed.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/jquery.mousewheel.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/jquery.touchSwipe.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/jquery.ba-throttle-debounce.min.js') }}"></script>
  <script defer src="{{ url('order/js/custom.js') }}"></script>
  <script type="text/javascript" src="{{ url('order/js/orderscript.js') }}"></script>
@stop