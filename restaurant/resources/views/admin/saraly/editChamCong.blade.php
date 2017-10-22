@extends('admin.layouts.master3')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa bảng chấm công</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
					<form  method="POST" action="{{route('admin.saraly.updateChamCong', $data->employer_id)}}" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<fieldset>
							<div class="form-group">
								<label class="col-sm-3 control-label">Ngày công</label>
								<div class="col-sm-4">
									<input type="text" name="ngay_cong" value="{{$data->ngay_cong}}" class="form-control" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Nghỉ có phép</label>
								<div class="col-sm-4">
									<input type="text" name="ngay_co_phep" value="{{$data->ngay_co_phep}}" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nghỉ không phép </label>
								<div class="col-sm-4">
									<input type="text" name="ngay_khong_phep" value="{{$data->ngay_khong_phep}}" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Làm thêm </label>
								<div class="col-sm-4">
									<input type="text" name="lam_them" value="{{$data->lam_them}}" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Ghi chú</label>								
								<div class="col-sm-4">
									<textarea rows="4" type="text" name="ghi_chu" value="" class="form-control" required>
										{{$data->ghi_chu}}
									</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tiền phạt </label>
								<div class="col-sm-4">
									<input type="text" name="tien_phat" value="{{$data->tien_phat}}" class="form-control">
								</div>
							</div>
							<div class="col-sm-6 form-group" style="margin-left: 127px;">
								<button type="submit" value="editChamCong" name="editChamCong" class="btn btn-primary" ><strong>Sửa</strong></button>
								<button type="reset" value="reset" name="reset" class="btn ">Reset</button>
							</div>
						</fieldset>
					</form>
	  			</div>
            </div>
        </div>
    </div>
@stop