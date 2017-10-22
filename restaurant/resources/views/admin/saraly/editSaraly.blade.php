@extends('admin.layouts.master3')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa bảng lương theo tháng</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
					<form  method="POST" action="{{route('admin.saraly.updateSaraly', $data->id)}}" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<fieldset>
							<div class="form-group">
								<label class="col-sm-3 control-label">Lương cơ bản </label>
								<div class="col-sm-6">
									<input type="text" name="luong_co_ban" value="{!!$data->luong_co_ban!!}" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Phụ cấp </label>
								<div class="col-sm-6">
									<input type="text" name="phu_cap" value="{{$data->phu_cap}}" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Khoản trừ </label>
								<div class="col-sm-6">
									<input type="text" name="khoan_tru" value="{{$data->khoan_tru}}" class="form-control">
								</div>
							</div>
							<div class="col-sm-6 form-group" style="margin-left: 127px;">
								<button type="submit" value="editSaraly" name="editSaraly" class="btn btn-primary" ><strong>Sửa</strong></button>
								<button type="reset" value="reset" name="reset" class="btn ">Reset</button>
							</div>
						</fieldset>
					</form>
	  			</div>
            </div>
        </div>
    </div>
@stop