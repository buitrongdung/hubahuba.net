@extends('layout.single2')
@section('content')
	<div class="container">
		<div style="width: 498px;margin-left: auto;margin-right: auto;">
			<div class="panel panel-primary" style="margin-top: 20px">
				<div class="panel-heading">
					<h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Sửa thông tin thành viên</h1>
				</div>
				<form id="formEditUser"  method="POST" action="{{route('updateUser', Auth::user()->id)}}" class="form-horizontal" style="margin-top: 15px;margin-left: 25px;">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<input type="hidden" name="id" value="{{Auth::user()->id}}">
					<fieldset>
						<div style="float: right">
							@include('block.flash')
							@include('block.error')
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Họ và tên</label>
							<div class="col-sm-6">
								<input type="text" name="name" value="{!! Auth::user()->name  !!}" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Giới tính </label>
							<div class="col-sm-" style="margin-top: 7px">
								<input type="radio" name="gender" value="Nam" @if(Input::old('gender')) checked @endif> Nam
								<input type="radio" name="gender" value="Nữ" @if(!Input::old('gender')) checked @endif> Nữ
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Email</label>
							<div class="col-sm-6">
								<input type="email" name="email" value="{!! Auth::user()->email  !!}" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Số điện thoại</label>
							<div class="col-sm-6">
								<input type="text" name="phone" value="{!! Auth::user()->phone  !!}" class="form-control" maxlength="11" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Địa chỉ</label>								
							<div class="col-sm-6">
								<textarea type="text" name="address" class="form-control"  >
									{!! Auth::user()->address  !!}
								</textarea>
							</div>
						</div>
						<div class="col-sm-4 form-group" style="margin-left: 108px;">
							<button type="submit" name="updateUser" class="butselect hvr-bounce-to-bottom" ><strong>Cập nhật</strong></button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{url('js/users.js')}}"></script>
@stop