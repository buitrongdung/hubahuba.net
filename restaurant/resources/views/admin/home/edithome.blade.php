@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa bài</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
				<form  method="POST" action="{{route('admin.home.update', $item->id)}}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						@include ('block.error')
						<div class="form-group">
							<label class="col-sm-3 control-label">Tên</label>
							<div class="col-sm-5">
								<input type="text" name="name" value="{{$item->name}}" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Loại bài đăng</label>
							<div class="col-sm-5">
								<select name="type" class="form-control">
									<option value="0">Ảnh nhỏ</option>
									<option value="1">Ảnh lớn</option>
									<option value="2">Slide</option>
									<option value="3">Khuyến mãi</option>
									<option value="4">Giới thiệu</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div>
							<label class="col-sm-3 control-label">Content</label>
							</div>
							<div class="col-sm-3" style="float: none;margin-left: 143px;margin-top: 0">
								<textarea type="text" name="content" class="form-control" style="width: 773px;height: 179px;">
									{{$item->content}}
								</textarea>
							</div>
						</div>
						<div class="col-sm-3 form-group" style="margin-left: 128px;width: 185px">
							<button type="submit" value="updateHome" name="updateHome" class="btn btn-primary" ><strong>Cập nhật</strong></button>
							<button type="reset" value="Reset" name="reset" class="btn">Reset</button>
						</div>
					</fieldset>
				</form>
				</div>
            </div>
        </div>
    </div>
@stop