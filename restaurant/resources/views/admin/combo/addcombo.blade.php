@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm thực đơn</h1>
                </div>
				<form  method="POST" action="{{route('admin.combo.store')}}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						@include ('block.error') 
						<div class="form-group">
							<label class="col-sm-3 control-label">Tên thực đơn</label>
							<div class="col-sm-3">
								<input type="text" name="name" value="{{old('name')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hình ảnh</label>
							<div class="col-sm-3">
								<input type="file" name="image" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Các món ăn</label>
							<div class="col-sm-3">
								<textarea type="text" name="content" value="{{old('content')}}" class="form-control" style="width:262px" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Giá</label>
							<div class="col-sm-3">
								<input type="text" name="price" value="{{old('price')}}" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-3 form-group" style="margin-left: 227px;">
							<button type="submit" value="Addcombo" name="addcombo" class="btn btn-primary" ><strong>Thêm</strong></button>
							<button type="reset" value="Reset" name="reset" class="btn btn-primary">Reset</button>
						</div>
					</fieldset>
				</form>
            </div>
        </div>
    </div>
@stop