@extends('layout.single3')
@section('title','Giỏ hàng')
@section('content')
	<div class="container">
		<div class="panel panel-primary" style="margin-top: 20px">
			<div class="panel-heading">
				<h1 class="panel-title" style="font-size: 37px;">Hoá đơn khách hàng</h1>
			</div>
			<form action="{!! route('postXacNhanMuaHang') !!}" method="POST">
				<input name="_token" type="hidden" value="{!! csrf_token() !!}" />
				<section id="cart_items">
					<div class="container">
						<div style="margin-top: 12px;">
							<div class="col-md-3" style="margin-bottom:20px;width: 235px;">
								<div class="form-group">
									<label>Tên khách hàng</label>
									<input type="hidden" style="width:270px" id="total_amount" name="total_amount" class="field-check " value="{!! number_format( $total * 0.3,0,".",".")!!}">

									<input class="form-control" id="fullname" name="buyer_fullname" value="{!! Auth::user()->name  !!}" readonly/>
								</div>
								<div class="form-group">
									<label>Số điện thoại</label>
									<input class="form-control" id="fullname" name="buyer_mobile" value="{!! Auth::user()->phone !!}" readonly/>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" id="fullname" name="buyer_email"  value="{!! Auth::user()->email !!}" readonly/>
								</div>
								<div class="form-group">
									<label>Yêu cầu của khách hàng</label>
									<textarea class="form-control" id="fullname" name='buyer_note' rows='3'></textarea>
								</div>
							</div>
						</div>

						<div class="col-md-8" style="width: 76.667%;">
							<table class="table table-bordered ">
								<caption><h3>Chi tiết đơn hàng</h3></caption>
								<thead>
								<tr>
									<th style="text-align: center;">Stt</th>
									<th style="text-align: center;width: 268px;">Tên</th>
									<th style="text-align: center;">Hình ảnh</th>
									<th style="text-align: center;">Giá</th>
									<th style="text-align: center;width: 63px;">Số lượng</th>
									<th style="text-align: center;">Tổng tiền</th>
								</tr>
								</thead>
								<tbody>
                                <?php
                                $total_amount = 0;
                                $stt=0;
                                ?>
								@foreach($content as $k=>$item)
                                    <?php
                                    //id , name,qty,price,option['image'],subtotal
                                    // echo "<pre>";
                                    // print_r($item);
                                    // echo "</pre>";
                                    // exit();
                                    $stt++;
                                    ?>
									<tr>
										<td style="text-align: center;">{!! $stt !!}</td>
										<td style="text-align: center;">{!! $item->name !!}</td>
										<td class="image"><img src="{!!asset('images/menu/'.$item['options']['img'])!!}" height="50" width="100" style="margin-right: -21px;" /></td>
										<td>{!! number_format($item->price,0,".",".") !!} VNĐ</td>
										<td style="text-align: center;">{!! $item->qty !!}</td>
										<td>{!! number_format( $item->price*$item->qty,0,".",".")!!} VNĐ</td>
									</tr>
								@endforeach

								</tbody>
							</table>
							<table class="table table-striped table-bordered ">
								<tr>
									<td><span class="extra bold totalamout">Thành tiền</span></td>
									<td><span class="bold totalamout" id="totalAmount" name="totalAmount">{!! number_format( $total,0,".",".")!!} VNĐ</span></td>
								</tr>
								<tr>
									<td><span class="extra bold totalamout">Thanh toán tiền trước (trả trước 30%)</span></td>
									<td><span class="bold totalamout" id="totalAmount" name="totalAmount">{!! number_format( $total * 0.3,0,".",".")!!} VNĐ</span></td>
								</tr>
							</table>
						</div>
						<h3>Chọn phương thức thanh toán</h3>
						<div style="float: left;margin-right: 105px;">
							<label style="margin-left: 15px"><input  type="radio" value="NL" name="option_payment" selected="true">Thanh toán trực tiếp tại nhà hàng</label>
							<button name="nlpayment" onclick="return xacnhanxoa('Hóa đơn sẽ được gửi qua email của quý khách!')" type="submit" class=" butselect hvr-bounce-to-bottom" style="border: none;float: left;color: white;font-size: 17px; margin: 4px -266px 0 15px" >
								Xác nhận
							</button>
						</div>
						<div style="float: left;margin: 72px 0 0 -385px">
							<ul class="list-content">
								<li class="active">
									<label style="float: left;margin-left: 14px;"><input  type="radio" value="NL" name="option_payment" selected="true">Thanh toán bằng Ví điện tử <span style="color:orange">Ngân Lượng</span></label>
									<div class="boxContent">
										<a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver={{Auth::user()->email}}&product_name=<?=session('orderNo')?>&price={!! $total * 0.3 !!}&return_url={{route('getXacNhanThanhCong')}}">
											<img style="margin: 20px 0 0 -321px " src="https://www.nganluong.vn/css/newhome/img/button/safe-pay-3.png"border="0" />
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</section> <!--/#cart_items-->
			</form>
			<script src="https://www.nganluong.vn/webskins/javascripts/jquery_min.js" type="text/javascript"></script>
			<script language="javascript">
                $('input[name="option_payment"]').bind('click', function() {
                    $('.list-content li').removeClass('active');
                    $(this).parent().parent('li').addClass('active');
                });
			</script>
		</div>
	</div>
	<style>
		ul.bankList {
			clear: both;
			height: 202px;
			width: 636px;
		}
		ul.bankList li {
			list-style-position: outside;
			list-style-type: none;
			cursor: pointer;
			float: left;
			margin-right: 0;
			padding: 5px 2px;
			text-align: center;
			width: 90px;
		}
		.list-content li {
			list-style: none outside none;
			margin: 0 0 10px;
		}

		.list-content li .boxContent {
			display: none;
			width: 636px;

			padding:10px;
		}
		.list-content li.active .boxContent {
			display: block;
		}
		.list-content li .boxContent ul {
			height:280px;
		}

		i.VISA, i.MASTE, i.AMREX, i.JCB, i.VCB, i.TCB, i.MB, i.VIB, i.ICB, i.EXB, i.ACB, i.HDB, i.MSB, i.NVB, i.DAB, i.SHB, i.OJB, i.SEA, i.TPB, i.PGB, i.BIDV, i.AGB, i.SCB, i.VPB, i.VAB, i.GPB, i.SGB,i.NAB,i.BAB
		{ width:80px; height:30px; display:block; background:url(https://www.nganluong.vn/webskins/skins/nganluong/checkout/version3/images/bank_logo.png) no-repeat;}
		i.MASTE { background-position:0px -31px}
		i.AMREX { background-position:0px -62px}
		i.JCB { background-position:0px -93px;}
		i.VCB { background-position:0px -124px;}
		i.TCB { background-position:0px -155px;}
		i.MB { background-position:0px -186px;}
		i.VIB { background-position:0px -217px;}
		i.ICB { background-position:0px -248px;}
		i.EXB { background-position:0px -279px;}
		i.ACB { background-position:0px -310px;}
		i.HDB { background-position:0px -341px;}
		i.MSB { background-position:0px -372px;}
		i.NVB { background-position:0px -403px;}
		i.DAB { background-position:0px -434px;}
		i.SHB { background-position:0px -465px;}
		i.OJB { background-position:0px -496px;}
		i.SEA { background-position:0px -527px;}
		i.TPB { background-position:0px -558px;}
		i.PGB { background-position:0px -589px;}
		i.BIDV { background-position:0px -620px;}
		i.AGB { background-position:0px -651px;}
		i.SCB { background-position:0px -682px;}
		i.VPB { background-position:0px -713px;}
		i.VAB { background-position:0px -744px;}
		i.GPB { background-position:0px -775px;}
		i.SGB { background-position:0px -806px;}
		i.NAB { background-position:0px -837px;}
		i.BAB { background-position:0px -868px;}

		ul.cardList li {
			cursor: pointer;
			float: left;
			margin-right: 0;
			padding: 5px 4px;
			text-align: center;
			width: 90px;
		}
	</style>
@endsection