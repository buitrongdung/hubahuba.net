@extends('layout.single')
@section('content')
	<div class="container">
		<div style="    padding-left: 258px;padding-right: 295px;">
			<div class="panel panel-primary" style="margin-top: 20px">
				<div class="panel-heading">
					<h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Đăng ký thành viên</h1>
				</div>
				<div class="container">
					<div>
					<form  method="POST" action="{{route('postDangky')}}" class="form-horizontal" style="margin-top: 15px">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<fieldset>
						@include ('block.error')
							<div class="form-group">
								<label class="col-sm-2 control-label">Họ và tên </label>
								<div class="col-sm-3">
									<input type="text" name="name" value="{{old('name')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Tên đăng nhập </label>
								<div class="col-sm-3">
									<input type="text" name="username" value="{{old('username')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Mật khẩu </label>
								<div class="col-sm-3">
									<input type="password" name="password" value="{{old('password')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
	                            <label class="col-sm-2 control-label">Xác nhận mật khẩu </label>
	                            <div class="col-sm-3">
	                                <input type="password" class="form-control" name="password_confirmation">
	                            </div>
	                        </div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Giới tính </label>
								<div class="col-sm-3" style="margin-top: 7px">
									<input type="radio" name="gender" value="Nam" @if(Input::old('gender')) checked @endif> Nam
									<input type="radio" name="gender" value="Nữ" @if(!Input::old('gender')) checked @endif> Nữ
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email </label>
								<div class="col-sm-3">
									<input type="email" name="email" value="{{old('email')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Số điện thoại </label>
								<div class="col-sm-3">
									<input type="text" name="phone" value="{{old('phone')}}" class="form-control" maxlength="11" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Địa chỉ </label>								
								<div class="col-sm-3">
									<textarea type="text" name="address" value="{{old('address')}}" class="form-control" required>
									</textarea>
								</div>
							</div>
							<div class="col-sm-2 form-group" style="margin-left: 180px;">
								<button type="submit" value="signup" name="signup" class="butselect hvr-bounce-to-bottom" style="float: left;width:106px;"><strong>Đăng ký</strong></button>
								<div style="margin-left: 117px;margin-top: 0px;">
									<button type="reset" value="reset" name="reset" class="btn" style="height: 37px;color: black;font-size: 18px;">Reset</button>
								</div>
							</div>
						</fieldset>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop