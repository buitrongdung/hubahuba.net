@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa thông tin</h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
					<form  method="POST" action="{{route('admin.menu.update', $menu->id)}}" class="form-horizontal">
						
						<input type="hidden" name="_method" value="PUT">
			    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<fieldset>
							@if(count($errors) > 0)
								@foreach ($errors->all() as $error)
									<p style="color:red">{{$error}}</p>
								@endforeach
							@endif 
							<div class="form-group">
								<label class="col-sm-3 control-label">Tên món ăn</label>
								<div class="col-sm-6">
									<input type="text" name="name" value="{{$menu->name}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Giá</label>
								<div class="col-sm-6">
									<input type="text" name="price" value="{{$menu->price}}" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label">Các món ăn</label>
									<div class="col-sm-6">
										<textarea rows="5" type="text" name="content" class="form-control">{{$menu->content}}</textarea>
									</div>
								</div>
							<div class="col-sm-3 form-group" style="margin-left: 128px;width: 161px">
								<button type="submit" value="editMenu" name="editMenu" class="btn btn-primary" ><strong>Sửa</strong></button>
								<button type="reset" value="Reset" name="reset" class="btn">Reset</button>
							</div>
						</fieldset>
					</form>
					</div>
				</div>
            </div>            
        </div> 
    </div>
@stop