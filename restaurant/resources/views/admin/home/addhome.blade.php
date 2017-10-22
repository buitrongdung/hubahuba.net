@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Đăng ảnh và post bài</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
				<form  method="POST" action="{{route('admin.home.store')}}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						@include ('block.error')
						<div class="form-group">
							<label class="col-sm-3 control-label">Tên</label>
							<div class="col-sm-3">
								<input type="text" name="name" value="{{old('name')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Loại bài đăng</label>
							<div class="col-sm-3">
								<select name="type" class="form-control">
									<option value="0">Ảnh nhỏ</option>
									<option value="1">Ảnh lớn</option>
									<option value="2">Slide</option>
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
							<div>
							<label class="col-sm-3 control-label">Content</label>
							</div>
							<div class="col-sm-3" style="float: none;margin-left: 143px;margin-top: -4px;">
								<textarea type="text" name="content" value="{{old('content')}}" class="form-control" style="width: 773px;height: 179px;" required></textarea>
							</div>
						</div>
						<div class="col-sm-3 form-group" style="margin-left: 128px;width: 161px">
							<button type="submit" value="Addmenu" name="addmenu" class="btn btn-primary" ><strong>Thêm</strong></button>
							<button type="reset" value="Reset" name="reset" class="btn ">Reset</button>
						</div>
					</fieldset>
				</form>
				</div>
            </div>
        </div>
    </div>
@stop