@extends('admin.layouts.master')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa thông tin</h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
						<form  method="POST" action="{{route('admin.combo.update', $combo->id)}}" class="form-horizontal">
							<input type="hidden" name="_method" value="PUT">
				    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<fieldset>
								@if(count($errors) > 0)
									@foreach ($errors->all() as $error)
										<p style="color:red">{{$error}}</p>
									@endforeach
								@endif 
								<div class="form-group">
									<label class="col-sm-3 control-label">Hình ảnh</label>
									<div class="col-sm-6">
										<input type="file" name="image" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Tên thực đơn </label>
									<div class="col-sm-6">
										<input type="text" name="name" value="{{$combo->name}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Các món ăn</label>
									<div class="col-sm-6">
										<textarea type="text" name="content" value="{{$combo->content}}" class="form-control" required></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Giá </label>
									<div class="col-sm-6">
										<input type="text" name="price" value="{{$combo->price}}" class="form-control" required>
									</div>
								</div>
								<div class="col-sm-6 form-group" style="margin-left: 136px;">
									<button type="submit" value="editCombo" name="editCombo" class="btn btn-primary" ><strong>Sửa</strong></button>
									<button type="reset" value="reset" name="reset" class="btn btn-primary">Reset</button>
								</div>
							</fieldset>
						</form>
					</div>
                </div>            
            </div> 
        </div>
    </div>
@stop