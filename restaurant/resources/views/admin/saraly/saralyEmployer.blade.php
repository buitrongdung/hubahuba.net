@extends('admin.layouts.master3')
@section('content')
 	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12">
		        <h1 class="page-header">Danh sách nhân viên</h1>
		    </div>
        	</span></br>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr align="center">
								<th style="width: 36px;">STT</th>
								<th>Hình ảnh</th>
								<th>Họ và tên</th>
								<th>Chức vụ</th>
								<th style="width: 86px;">Tiền lương</th>
							</tr>
						</thead>
						<tbody>
						<?php $stt = 0 ?>
						@foreach ($emps as $emp)
							<?php $stt += 1 ?>
							<tr class="odd gradeX" align="center">
								<th scope="row">{{ $stt }}</th>
								<td>
									<img style="height: 32px" src="{!!asset('images/employer/'.$emp['image'])!!}">
								</td>
								<td>{{ $emp['name'] }}</td>
								<td>
									@if ($emp['type_employer'] == 0)
										{!! "None"!!}
									@else
										<?php
											$data = DB::table('type_employer')->where('id_employer', $emp['type_employer'])->first();
											echo $data->description;
										?>
									@endif
								</td>
								
									<?php 
										$chamCong = DB::table('cham_cong')->select('employer_id')->where('employer_id', '=', $emp->id_employer)->first();

										if (empty($chamCong->employer_id)) {
											echo "<td>Chưa chấm công</td>";
											
										} else {
											
											echo "<td><a style='color: blue;font-size: 16px' href=".route('admin.saraly.payroll',$emp->id_employer)."><i class='fa fa-search-plus'>
											Xem chi tiết	</i></a></td>";
										}
									?>
								
							</tr>
						@endforeach
						</tbody>
					</table>
			</div>	
		</div>
	</div> 
@stop