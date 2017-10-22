@extends('admin.layouts.master5')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
                    <h1 class="page-header">Thay đổi mật khẩu</h1>
            </div>
            @include ('block.flash')
			@include ('block.error')
			<div class="col-lg-7" style="padding-bottom:120px">
				<form  method="POST" action="{{ route('admin.employer.postpassword')}}" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						<div class="form-group">
							<label class="col-sm-3 control-label">Mật khẩu cũ</label>
							<div class="col-sm-6">
								<input type="text" name="oldPass" value="{{old('oldPass')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Mật khẩu mới</label>
							<div class="col-sm-6">
								<input type="text" name="password" value="{{old('password')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nhập lại mật khẩu mới</label>
							<div class="col-sm-6">
								<input type="password" name="password_confirmation" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-6 form-group" style="margin-left: 127px;">
							<button type="submit" name="changePass" class="btn btn-primary" ><strong>Cập nhật</strong></button>
						</div>
					</fieldset>						
				</form>
			</div>
		</div>
	</div>
</div>
@stop