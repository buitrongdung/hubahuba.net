@extends('layout.single2')
@section('content')
	<div class="container">
	@include ('block.flash')
		<div style="width: 411px;margin-left: auto;margin-right: auto;">
			<div class="panel panel-primary" style="margin-top: 20px">

				<div class="panel-heading">
					<h5 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Thông tin của khách hàng</h5>
				</div>

				<form action="" method="POST">
					<input name="_token" type="hidden" value="{!! csrf_token() !!}" />
					<section id="cart_items">
						<div class="container">
							<div class="col-md-4" style="margin-bottom:20px;margin-top: 9px">
								<div class="form-group">
								    <label>Tên khách hàng</label>
								    <input class="form-control" value="{!! Auth::user()->name !!}" readonly/>
								</div>
								<div class="form-group">
								    <label>Giới tính</label>
								    <input class="form-control" value="{!! Auth::user()->gender !!}" readonly/>
								</div>
								<div class="form-group">
								    <label>Số điện thoại</label>
								    <input class="form-control" value="{!! Auth::user()->phone !!}" readonly/>
								</div>
								<div class="form-group">
								    <label>Email</label>
								    <input class="form-control" value="{!! Auth::user()->email !!}" readonly/>
								</div>
								<div class="form-group">
								    <label>Địa chỉ</label>
								    <input class="form-control" value="{!! Auth::user()->address !!}" readonly/>
								</div>
								<div style="float: left">
									<div class="form-group">
										<div>
											<a class="butselect hvr-bounce-to-bottom" style="border: none;float: left;width: 106px;color: white;padding-top: 6px;padding-left: 14px;" href="{{ route('editUser')}}">
										Chỉnh sửa</a>
										<a class="butselect hvr-bounce-to-bottom" style="border: none;float: left;color: white;padding-top: 6px;padding-left: 9px;width:114px;margin-left: 68px;" href="{{ route('getChangePassword')}}">
										Đổi mật khẩu</a>
											<a class="butselect hvr-bounce-to-bottom" style="border: none;float: right;color: white;padding-top: 6px; width: 113px;padding-left: 14px;margin-left: 69px" href="{{ route('getShowOrder', Auth::user()->id) }}">
												Xem đặt bàn</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section> <!--/#cart_items-->
				</form>
			</div>
		</div>
	</div>
@stop