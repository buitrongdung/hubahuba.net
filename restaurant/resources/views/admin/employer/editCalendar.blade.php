@extends('admin.layouts.master3')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tạo lịch làm việc nhân viên</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
					<form  method="POST" action="{{route('admin.employer.postCalendar')}}" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<fieldset>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Tuần 1</label>
								<div class="col-sm-3">
									<select class="form-control" name="week_1[]" id="week_1" >
										@if (!empty($cals))
											@foreach($cals as $cal)
												@if (!empty(old('week_1')))
													<option value="{{$cal->id}}" @if (in_array($cal->id, old('week_1'))) selected @endif >{{$cal->name}}</option>
												@else
													<option value="{{$cal->id}}" >{{$cal->name}}</option>
												@endif
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tuần 2</label>
								<div class="col-sm-3">
									<select class="form-control" name="week_2[]" id="week_2" >
										@if (!empty($cals))
											@foreach($cals as $cal)
												@if (!empty(old('week_2')))
													<option value="{{$cal->id}}" @if (in_array($cal->id, old('week_2'))) selected @endif >{{$cal->name}}</option>
												@else
													<option value="{{$cal->id}}" >{{$cal->name}}</option>
												@endif
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tuần 3</label>
								<div class="col-sm-3">
									<select class="form-control" name="week_3[]" id="week_3" >
										@if (!empty($cals))
											@foreach($cals as $cal)
												@if (!empty(old('week_3')))
													<option value="{{$cal->id}}" @if (in_array($cal->id, old('week_3'))) selected @endif >{{$cal->name}}</option>
												@else
													<option value="{{$cal->id}}" >{{$cal->name}}</option>
												@endif
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tuần 4</label>
								<div class="col-sm-3">
									<select class="form-control" name="week_4[]" id="week_4" >

										@if (!empty($cals))
											@foreach($cals as $cal)
												@if (!empty(old('week_4')))
													<option value="{{$cal->id}}" @if (in_array($cal->id, old('week_4'))) selected @endif >{{$cal->name}}</option>
												@else
													<option value="{{$cal->id}}" >{{$cal->name}}</option>
												@endif
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="col-sm-4 form-group" style="margin-left: 136px;">
								<button type="submit" value="update" name="update" class="btn btn-primary" ><strong>Cập nhật</strong></button>
								<button type="reset" value="reset" name="reset" class="btn ">Reset</button>
							</div>
						
						</fieldset>
					</form>
	  			</div>
            </div>
        </div>
    </div>
@stop