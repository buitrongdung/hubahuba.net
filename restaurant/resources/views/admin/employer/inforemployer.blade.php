@extends('admin.layouts.master3')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thông tin nhân viên</h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Chức vụ: </strong>
							@if ($emp['type_employer'] == 0)
								{!! "None" !!}
							@else
								<?php
									$data = DB::table('type_employer')->where('id_employer', $emp['type_employer'])->first();
									echo $data->description;
								?>
							@endif
						</div>
					</div>
					<div class="col-xs-12" >
						<div class="form-group">
							<strong>Mã nhân viên: </strong>
							{{$emp->id_employer}}
						</div>
					</div>
					<div class="col-xs-12" >
						<div class="form-group">
							<strong>Họ và tên: </strong>
							{{$emp->name}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Chứng minh nhân dân: </strong>
							{{$emp->cmnd}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Ngày sinh: </strong>
							<?php
							echo date("d-m-Y", strtotime($emp->birthday));
							?>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Giới tính: </strong>
							{{$emp->gender}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Số điện thoại: </strong>
							0{{$emp->phone}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Email: </strong>
							{{$emp->email}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Dân tộc: </strong>
							{{$emp->ethnic}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Tôn giáo: </strong>
							{{$emp->religion}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Quốc gia: </strong>
							{{$emp->country}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Bằng cấp: </strong>
							{{$emp->diploma}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Địa chỉ: </strong>
							{{$emp->address}}
						</div>
					</div>
					<div class="image-face">
						<img class="image-emp" src="{{asset('images/employer/'.$emp->image)}}">
					</div>
				</div>
            </div>
        </div>
    </div>	
@stop