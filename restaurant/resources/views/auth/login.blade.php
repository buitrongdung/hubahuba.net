@extends('layout.single')
@section('content')

	<div class="container">
		@include ('block.flash')
		<div style="width: 482px;margin-left: 327px;">
			<div class="panel panel-primary" style="margin-top: 20px">
				<div class="panel-heading">
					<h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Đăng nhập</h1>
				</div>
				@include ('block.error')
				<form action="{{url ('auth/login')}}" role="form" method="POST" class="form-horizontal" style="margin-top: 13px">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>						
						<div class="form-group">
		                    <label class="col-sm-3 control-label" style="width: 174px;">Tên đăng nhập</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
		                    </div>
		                </div>
						<div class="form-group">
							<label class="col-sm-3 control-label" style="width: 174px;">Mật khẩu</label>
							<div class="col-sm-6">
								<input type="password" name="password" class="form-control" required>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 13px;margin-left: 179px;">
							<button type="submit" value="Login" name="login" class="butselect hvr-bounce-to-bottom" style="float: left;width: 106px;"><strong>Đăng nhập</strong></button>
							<div style="margin-top: 14px">
								<a style=" margin-left:67px;text-decoration: underline;color: blue;font-style: italic;" href="{{route('getSignUp')}}">Đăng ký</a>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
@stop