@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm thông tin admin</h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
						<form  method="POST" action="{{route('admin.show.store')}}" class="form-horizontal">
							
				    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<fieldset>
								@include ('block.error')
								<div class="form-group">
									<label class="col-sm-3 control-label">Email </label>
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
								<div class="form-group">
									<label class="col-sm-3 control-label">Quyền admin mới </label>
									<div class="col-sm-6">
										<select class="form-control" name="level">
											<option value="1">Quản trị viên</option>
											<option value="2">Quản trị khách hàng</option>
											<option value="3">Quản trị nhân sự</option>
										</select>
									</div>
								</div>							
								<div class="form-group">
									<label class="col-sm-3 control-label">Số điện thoại </label>
									<div class="col-sm-6">
										<input type="text" name="phone" value="{{old('phone')}}" class="form-control" maxlength="11" required>
									</div>
								</div>								
								<div class="form-group">
									<label class="col-sm-3 control-label">Địa chỉ </label>								
									<div class="col-sm-6">
										<textarea type="text" name="address" value="{{old('address')}}" class="form-control" rows="3" required>
										</textarea>
									</div>
								</div>
								<div class="col-sm-6 form-group" style="margin-left: 127px;">
									<button type="submit" value="edit" name="edit" class="btn btn-primary" ><strong>Thêm</strong></button>
									<button type="reset" value="reset" name="reset" class="btn">Reset</button>
								</div>
							</fieldset>
						</form>
					</div>
                </div>            
            </div> 
        </div>
    </div>
@stop