@extends('layout.single')
@section('content')
	<div class="container">
		<div class=" contact-grid wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s" style="border: 1px black solid">
			<h3 class="tittle wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Đăng nhập</h3>
			<form action="{{ url('/password/email') }}" role="form" method="POST" class="form-horizontal">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<fieldset>
					@if(count($errors) > 0)
						@foreach ($errors->all() as $error)
							<p style="color:red">{{$error}}</p>
						@endforeach
					@endif
					<div class="form-group">
	                    <label class="col-sm-3 control-label">Email</label>
	                    <div class="col-sm-4">
	                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
	                    </div>
	                </div>
					<div class="form-group" style="margin-bottom: 0px;margin-left: 253px;">
						<button type="submit" value="Login" name="login" class="btn btn-primary" ><strong>Gửi thay đổi mật khẩu đến link</strong></button>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>		
@stop