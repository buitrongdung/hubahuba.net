@extends('admin.layouts.master2')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thông tin khách hàng</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
					<div class="col-xs-12" >
						<div class="form-group">
							<strong>Name:</strong>
							{{$user->name}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Username:</strong>
							{{$user->username}}
						</div>
					</div>
					<!-- <div class="col-xs-12">
						<div class="form-group">
							<strong>Ngày sinh:</strong>
							{{$user->birthday}}
						</div>
					</div> -->
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Giới tính:</strong>
							{{$user->gender}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Số điên thoại:</strong>
							{{$user->phone}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Email:</strong>
							{{$user->email}}
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<strong>Địa chỉ: </strong>
							{{$user->address}}
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>	
@stop