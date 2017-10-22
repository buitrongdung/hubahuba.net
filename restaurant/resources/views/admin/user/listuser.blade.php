@extends('admin.layouts.master2')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12">
		        <h1 class="page-header">Danh sách khách hàng thành viên</h1>
		    </div>
		    <span style="margin-left: 13px"><b>Số khách hàng: </b> 
		    	<?php 
		    		$user = DB::table('users')->where('level', '=', '0')->get();
		    		echo count($user);
		    	?>
		    </span>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th style="width: 0px;">STT</th>
							<th>Họ và tên</th>
							<th>Giới tính</th>
							<th>Số điện thoại</th>
							<th>Email</th>
							<th>Xem chi tiết</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($users as $user)
						<?php $stt += 1 ?>
						<tr>
							<th scope="row">{{ $stt }}</th>
							<td>{{ $user->name }}</td>
							<td>{{ $user->gender }}</td>
							<td>{{ $user->phone }}</td>
							<td>{{ $user->email }}</td>
							<td style="width: 0px;text-align: center;">
								<a style="color: blue;font-size: 16px" href="{{route('admin.user.show', $user->id)}}"><i class="fa fa-search-plus" aria-hidden="true"> Xem chi tiết	</i>
								</a>
							</td>
							
								<form method="POST" action="{{route('admin.user.destroy', $user->id)}}">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input type="hidden" value="DELETE" name="_method">
									<td style="text-align: center;" class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')" value="Delete" /></td>
								</form>
							
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop