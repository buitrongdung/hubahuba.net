@extends('layout.single2')
@section('content')
<div class="container">
	@include ('block.flash')
	<div style="padding-left: 258px;padding-right: 295px;">
		<div class="panel panel-primary" style="margin-top: 20px">
			<div class="panel-heading">
				<h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Thay đổi mật khẩu</h1>
			</div>
			@include ('block.error')
			<div class="container">
				<form  method="POST" action="{{ route('postChangePassword')}}" class="form-horizontal" style="margin-top: 15px">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mật khẩu cũ</label>
							<div class="col-sm-3">
								<input type="text" name="oldPass" value="{{old('oldPass')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mật khẩu mới</label>
							<div class="col-sm-3">
								<input type="text" name="password" value="{{old('password')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Nhập lại mật khẩu mới</label>
							<div class="col-sm-3">
								<input type="password" name="password_confirmation" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-3 form-group" style="margin-left: 227px;">
							<button type="submit" name="changePass" class="butselect hvr-bounce-to-bottom" style="float: left;width:106px;"><strong>Cập nhật</strong></button>
						</div>
					</fieldset>						
				</form>
			</div>
		</div>
	</div>
</div>
@stop