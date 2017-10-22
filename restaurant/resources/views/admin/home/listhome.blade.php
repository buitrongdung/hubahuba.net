@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12" style="margin-bottom: -18px;">
		        <h1 class="page-header">Danh sách ảnh và chữ
		        	<a href="{{route('admin.home.create')}}" class="btn btn-primary">+ Tạo</a>
		        </h1>
		    </div>
			<div class="panel-body">

				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th style="width: 0px;">STT</th>
							<th>Hình ảnh</th>
							<th>Loại</th>
							<th>Tên</th>
							<th>Content</th>
							<th>Edit</th>
								<th style="width: 63px">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($home as $item)
						<?php $stt += 1 ?>
						<tr>
							<th scope="row">{{ $stt }}</th>
							<td style="text-align: center">
								<img style="height: 32px;width: 48px" src="{!!asset('images/'.$item->image)!!}">
							</td>
							<td>
							@if ($item['type'] == 0)
								<font>nhỏ</font>
							@elseif ($item['type'] == 1)
								<font>lớn</font>
							@elseif ($item['type'] == 2)
								<font>Slide</font>
							@elseif ($item['type'] == 3)
								<font>Khuyến mãi</font>
							@else ($item['type'] == 4)
								<font>Giới thiệu</font>
							@endif
							</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->content}}</td>
							
							
								<form method="POST" action="{{route('admin.home.destroy',$item['id'])}}">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input type="hidden" value="DELETE" name="_method">
									<td style="width: 75px" class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')" value="Delete" /></td>
								</form>
							
							<td style="text-align: center;" class="center"><i class="fa fa-pencil fa-fw"></i><a href="{{route('admin.home.edit', $item['id'])}}">Edit</a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<style type="text/css">
	#menu ul{
		list-style-type:none;
		padding:0px;
		margin:0px;
		background-repeat: #333;
	}

	#menu ul li{
		display:inline;
		text-transform: uppercase;
	}
	#menu ul a{
		text-decoration:none;
		width:244px;
		float:left;
		background:white;
		color:black;
		font-weight:bold;
		text-align:center;
		line-height:35px;
		border-left:1px solid #fff;
	}
</style>
	
@stop