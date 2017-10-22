@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa thông tin</h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
						<form  method="POST" action="{{route('admin.show.update', $user->id)}}" class="form-horizontal">
							<input type="hidden" name="_method" value="PUT">
				    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<fieldset>
								@include ('block.error')
								<div class="form-group">
									<label class="col-sm-3 control-label">Quyền admin cũ </label>
									<div class="col-sm-6">										
										@if ($user->level == 2)
										<input type="text" value="Quản trị khách hàng" class="form-control" readonly>				
										@elseif ($user->level == 3)
										<input type="texxt" value="Quản trị nhân sự" class="form-control" readonly>
										@endif									
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Email </label>
									<div class="col-sm-6">
										<input type="email" name="email" value="{{$user->email}}" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Quyền admin mới </label>
									<div class="col-sm-6">
										<select class="form-control" name="level">
											<option value="0">Không phân quyền admin</option>
											<option value="1">Quản trị viên</option>
											<option value="2">Quản trị khách hàng</option>
											<option value="3">Quản trị nhân sự</option>
										</select>
									</div>
								</div>							
								<div class="form-group">
									<label class="col-sm-3 control-label">Số điện thoại </label>
									<div class="col-sm-6">
										<input type="text" name="phone" value="{{$user->phone}}" class="form-control" maxlength="11" required>
									</div>
								</div>								
								<div class="form-group">
									<label class="col-sm-3 control-label">Địa chỉ </label>								
									<div class="col-sm-6">
										<textarea type="text" name="address" class="form-control" rows="3" required>
											{{$user->address}}
										</textarea>
									</div>
								</div>
								<div class="col-sm-6 form-group" style="margin-left: 127px;">
									<button type="submit" value="edit" name="edit" class="btn btn-primary" ><strong>Sửa</strong></button>
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