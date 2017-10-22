@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm món ăn / đồ uống</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
				<form  method="POST" action="{{route('admin.menu.store')}}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						@include ('block.error')
						<div class="form-group">
							<label class="col-sm-3 control-label">Tên</label>
							<div class="col-sm-6">
								<input type="text" name="name" value="{{old('name')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Kiểu món ăn / đồ uống</label>
							<div class="col-sm-3 control-label" style="text-align:left;">
								<select class="form-control" name="menus[]" id="menus" >
									@if (!empty($menus))
										@foreach($menus as $menu)
											@if (!empty(old('menus')))
												<option value="{{$menu->id}}" @if (in_array($menu->id, old('menus'))) selected @endif >{{$menu->name}}</option>
											@else
												<option value="{{$menu->id}}" >{{$menu->name}}</option>
											@endif
										@endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hình ảnh</label>
							<div class="col-sm-5">
								<input type="file" name="image" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Giá</label>
							<div class="col-sm-6">
								<input type="text" name="price" value="{{old('price')}}" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Các món ăn</label>
							<div class="col-sm-5">
								<textarea rows="5" type="text" name="content" value="{{old('content')}}" class="form-control" style="width:262px" required></textarea>
							</div>
						</div>

						<div class="col-sm-3 form-group" style="margin-left: 128px;width: 161px">
							<button type="submit" value="Addmenu" name="addmenu" class="btn btn-primary" ><strong>Thêm</strong></button>
							<button type="reset" value="Reset" name="reset" class="btn">Reset</button>
						</div>
					</fieldset>
				</form>
				</div>
            </div>
        </div>
    </div>
@stop