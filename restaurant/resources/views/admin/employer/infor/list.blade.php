@extends('admin.layouts.master1')
@section('content')
 	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12">
		        <h1 class="page-header">Danh sách Admin
		        	<a href="{{route('admin.show.add')}}" class="btn btn-primary">+ Thêm admin</a>
		        </h1>
		    </div>
		    <span style="margin-left: 13px"><b>Số nhân viên admin:</b> 
		    	<?php 
		    		$user = DB::table('users')->where('level', '!=', '4')->where('level', '!=', '0')->get();
		    		echo count($user);
		    	?>
		    </span>
		    
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr align="center">
								<th style="width: 0px;">STT</th>
								<th>Quyền admin</th>
								<th>Email</th>
								<th>Số điện thoại</th>
								<th>Delete</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
						<?php $stt = 0 ?>
						@foreach ($users as $user)
							<?php $stt += 1 ?>
							<tr class="odd gradeX" align="center">
								<th scope="row">{{ $stt }}</th>
								@if ($user->level == 1)
								<td><font>Quản trị viên</font></td>
								@elseif ($user->level == 2)
								<td><font>Quản trị khách hàng</font></td>
								@elseif ($user->level == 3)
								<td><font>Quản trị nhân sự</font></td>
								@endif
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone }}</td>
								<td style="text-align: center;" class="center"><i class="fa fa-pencil fa-fw"></i>
									<a href="{{route('admin.show.editAdmin', $user->id)}}">Edit</a>
								</td>
								<form method="POST" action="{{route('admin.show.destroy', $user->id)}}">
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