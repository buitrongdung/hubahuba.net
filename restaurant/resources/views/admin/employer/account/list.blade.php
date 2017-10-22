@extends('admin.layouts.master1')
@section('content')
 	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12">
		        <h1 class="page-header">Danh sách tài khoản nhân viên
		        </h1>
		    </div>
		    <span style="margin-left: 13px"><b>Số tài khoản nhân viên:</b> 
		    	<?php 
		    		$user = DB::table('users')->where('level', '=', '4')->get();
		    	echo count($user);?>
		    </span>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr align="center">
							<th style="width: 0px;">STT</th>
							<th>Họ và tên</th>
							<th>Email</th>
							<th>Tài khoản</th>
							<th>Tạo tài khoản</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($emps as $emp)
						<?php $stt += 1 ?>
						<tr class="odd gradeX" align="center">
							<th scope="row">{{ $stt }}</th>
							<td>{{ $emp['name'] }}</td>
							<td>{!! $emp->email !!}</td>								
							<?php 
								$user = DB::table('users')->select('email')->where('email', '=', $emp->email)->first();
								if (!empty($user->email) && $emp->email === $user->email) {
									echo "<td>".$user->email."</td>";
									echo "<td>&nbsp;</td>";					
								} else {
									echo "<td>None</td>";
									echo "<td style='width: 0px;'>
											<a style='color: blue;font-size: 16px' href=".route('admin.account.createAccount', $emp->id_employer)."><i class='fa fa-search-plus' aria-hidden='true'>Tạo tài khoản</i>
											</a>
										</td>";
								}
							?>						
							
							<form method="POST" action="">
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