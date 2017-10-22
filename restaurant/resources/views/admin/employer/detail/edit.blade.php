@extends('admin.layouts.master3')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa thông tin</h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
						<form id="formEditDetailEmp" method="POST" action="{{route('admin.employer.updateDetail', $emp->id_employer)}}" class="form-horizontal">
							<input type="hidden" name="_method" value="PUT">
				    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id_employer" value="{{$emp->id_employer}}">
							<fieldset>
								@include('block.error')
								@include('block.flash')
								<div class="form-group">
									<label class="col-sm-3 control-label">Họ và tên </label>
									<div class="col-sm-6">
										<input type="text" name="name" value="{{$emp->name}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Chứng minh nhân dân</label>
									<div class="col-sm-6">
										<input type="text" name="cmnd" value="{{$emp->cmnd}}" class="form-control" maxlength="11" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Giới tính </label>
									<div class="col-sm-6">
										<input type="radio" name="gender" value="Nam" @if(Input::old('gender')) checked @endif> Nam
										<input type="radio" name="gender" value="Nữ" @if(!Input::old('gender')) checked @endif> Nữ
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Ngày sinh </label>
									<div class="col-sm-6">
										<input type="date" name="birthday" class="form-control" maxlength="10" value="{{$emp->birthday}}" placeholder="00-00-0000" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Email </label>
									<div class="col-sm-6">
										<input type="email" name="email" value="{{$emp->email}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Số điện thoại </label>
									<div class="col-sm-6">
										<input type="text" name="phone" value="{{$emp->phone}}" class="form-control" maxlength="11" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Tôn giáo </label>
									<div class="col-sm-6">
										<input type="text" name="religion" value="{{$emp->religion}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Dân tộc </label>
									<div class="col-sm-6">
										<input type="text" name="ethnic" value="{{$emp->ethnic}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Quốc tịch </label>
									<div class="col-sm-6">
										<input type="text" name="country" value="{{$emp->country}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Bằng cấp </label>
									<div class="col-sm-6">
										<textarea type="text" name="diploma" class="form-control" required>
										{{$emp->diploma}}
										</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Địa chỉ </label>								
									<div class="col-sm-6">
										<textarea type="text" name="address" class="form-control" required>
											{{$emp->address}}
										</textarea>
									</div>
								</div>
								<div class="col-sm-6 form-group" style="margin-left: 136px;">
									<button type="submit" value="editEmp" name="editEmp" class="btn btn-primary" ><strong>Sửa</strong></button>
									<button type="reset" value="reset" name="reset" class="btn">Reset</button>
								</div>
							</fieldset>
						</form>
					</div>
                </div>            
            </div> 
        </div>
    </div>
	<script type="text/javascript" src="{{url('admin/js/employee.js')}}"></script>
@stop