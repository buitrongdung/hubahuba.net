@extends('admin.layouts.master')
@section('content')
 	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12">
		        <h1 class="page-header">Danh sách thực đơn
		        	<a href="{{route('admin.combo.create')}}" class="btn btn-primary">+ Tạo</a>
		        </h1>
		    </div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr align="center">
							<th style="width: 0px;">STT</th>
							<th>Hình ảnh</th>
							<th>Tên thực đơn</th>
							<th>Content</th>
							<th>Price</th>
							<th>Edit</th>
							<th style="width: 63px">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($combos as $combo)
						<?php $stt += 1 ?>
						<tr class="odd gradeX" align="center">
							<th scope="row">{{ $stt }}</th>
							<td>
								<img style="height: 32px" src="{!!asset('images/combo/'.$combo['image'])!!}">
							</td>
							<td>{{ $combo['name'] }}</td>
							<td> {{$combo['content']}}</td>
							<td><?php echo number_format($combo->price,3,".","."); ?> VND</td>
							<th style="width: 68px;">
								<a href="{{route('admin.combo.edit', $combo['id'])}}" class="list-group-item fa fa-pencil fa-fw" style="width: 72px;font-size: 15px;height: 31px;margin-top: -4px;"> 
								Sửa		</a>
								</th>
							<th style="width: 0px;">
								<form method="POST" action="{{route('admin.combo.destroy', $combo['id'])}}">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input type="hidden" value="DELETE" name="_method">
									<button style="height: 31px;margin-top: -4px; font-size:15px;" onclick="return xacnhanxoa('Bạn có muốn xóa?')" type="submit" class="btn btn-danger fa fa-trash-o fa-lg" value="Delete"> Xóa</button>
								</form>
							</th>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>	
		</div>
	</div> 
@stop