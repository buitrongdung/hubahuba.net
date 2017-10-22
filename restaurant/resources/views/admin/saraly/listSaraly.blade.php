@extends('admin.layouts.master3')
@section('content')
 	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12">
		        <h1 class="page-header">Bảng lương tháng
		        	<a href="{{route('admin.saraly.calendar')}}" class="btn btn-primary">+ Tạo</a>
		        </h1>
		    </div>
		    
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr align="center">
							<th style="width: 0px;">STT</th>
							<th>Chức vụ</th>
							<th style="width: 61px">Ngày công chuẩn</th>
							<th>Lương cơ bản</th>
							<th>Phụ cấp</th>
							<th>Khoản trừ</th>
							<th>Delete</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($saraly as $data)
						<?php $stt += 1 ?>
						<tr class="odd gradeX" align="center">
							<th scope="row">{{ $stt }}</th>
							<td>
								@if ($data['type_employer_id'] == 0)
									{!! "None"!!}
								@else
									<?php
										$item = DB::table('type_employer')->where('id_employer', $data['type_employer_id'])->first();
										echo $item->description;
									?>
								@endif
							</td>
							<td>{!! $data['ngay_cong_chuan'] !!}</td>
							<td>{!! number_format($data->luong_co_ban,0,".",".") !!} VNĐ</td>
							<td>{!! number_format($data->phu_cap,0,".",".") !!} VNĐ</td>
							<td>							
								{!! number_format($data->khoan_tru,0,".",".") !!} VNĐ
							</td>
							<form method="POST" action ="{{route('admin.saraly.destroy', $data->id)}}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="id" value="" />
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa?')" value="Delete" /></td>
                            </form>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a href="{{route('admin.saraly.editSaraly', $data->id)}}">Edit</a></td>
						
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>	
		</div>
	</div> 
@stop