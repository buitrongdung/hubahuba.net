@extends('admin.layouts.master3')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm nhân viên</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
					<form  method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<fieldset>
							@include ('block.error')
								<div class="form-group">
									<label class="col-sm-3 control-label">Chức vụ </label>
									<div class="col-sm-3">
										<select class="form-control" name="typeEmps[]" id="typeEmps" >
											@if (!empty($typeEmps))
												@foreach($typeEmps as $typeEmp)
													@if (!empty(old('typeEmps')))
														<option value="{{$typeEmp->id_employer}}" @if (in_array($typeEmp->id_employer, old('typeEmps'))) selected @endif >{{$typeEmp->description}}</option>
													@else
														<option value="{{$typeEmp->id_employer}}" >{{$typeEmp->description}}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Hình ảnh</label>
								<div class="col-sm-3">
									<input type="file" name="image" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Họ và tên </label>
								<div class="col-sm-6">
									<input type="text" name="name" value="{{old('name')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Chứng minh nhân dân </label>
								<div class="col-sm-6">
									<input type="text" name="cmnd" value="{{old('cmnd')}}" class="form-control" maxlength="15" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Ngày sinh </label>
								<div class="col-sm-6">
									<input type="date" name="birthday" class="form-control" maxlength="10" placeholder="00-00-0000" required>
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
								<label class="col-sm-3 control-label">Email </label>
								<div class="col-sm-6">
									<input type="email" name="email" value="{{old('email')}}" class="form-control" required>
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
									<textarea type="text" name="address" value="{{old('address')}}" class="form-control" required>
									</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tôn giáo </label>
								<div class="col-sm-6">
									<input type="text" name="religion" value="{{old('religion')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Dân tộc </label>
								<div class="col-sm-6">
									<input type="text" name="ethnic" value="{{old('ethnic')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Quốc tịch </label>
								<div class="col-sm-6">
									<input type="text" name="country" value="{{old('country')}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Bằng cấp </label>
								<div class="col-sm-6">
									<textarea type="text" name="diploma" value="{{old('diploma')}}" class="form-control">
									</textarea>
								</div>
							</div>
							<div class="col-sm-6 form-group" style="margin-left: 136px;">
								<button type="submit" value="signup" name="signup" class="btn btn-primary" ><strong>Thêm</strong></button>
								<button type="reset" value="reset" name="reset" class="btn btn-primary">Reset</button>
							</div>
						</fieldset>
					</form>
	  			</div>
            </div>
        </div>
    </div>
@stop