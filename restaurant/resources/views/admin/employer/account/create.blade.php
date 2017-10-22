@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm tài khoản nhân viên</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
					<form  method="POST" action="{{route('admin.account.storeAccount', $emp->id_employer)}}" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<fieldset>
							@include ('block.error')
							<input type="hidden" name="idEmployer" value="{{$emp->id_employer}}">
							<div class="form-group">
								<label class="col-sm-3 control-label">Họ và tên </label>
								<div class="col-sm-6">
									<input type="text" name="name" value="{{$emp->name}}" class="form-control" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Email </label>
								<div class="col-sm-6">
									<input type="email" name="email" value="{{$emp->email}}" class="form-control" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tên tài khoản </label>
								<div class="col-sm-6">
									<input type="email" name="email" value="{{old('email')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Mật khẩu </label>
								<div class="col-sm-6">
									<input type="password" name="password" value="{{old('password')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
	                            <label class="col-sm-3 control-label">Xác nhận mật khẩu </label>
	                            <div class="col-sm-6">
	                                <input type="password" class="form-control" name="password_confirmation">
	                            </div>
		                    </div>
							<div class="col-sm-6 form-group" style="margin-left: 128px;">
								<button type="submit" value="signup" name="signup" class="btn btn-primary" ><strong>Thêm</strong></button>
								<button type="reset" value="reset" name="reset" class="btn">Reset</button>
							</div>
						</fieldset>
					</form>
	  			</div>
            </div>
        </div>
    </div>
@stop