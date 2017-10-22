@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12" style="margin-bottom: -18px;">
		        <h1 class="page-header">Danh sách bài viết
		        	<a href="{{route('admin.post.createNews')}}" class="btn btn-primary">+ Thêm bài viết</a>
		        </h1>
		    </div>
		    <span style="margin-left: 13px"><b>Số bài viết: </b> 
		    	<?php 
		    		$news = DB::table('news')->get();
		    		echo count($news);
		    	?>
		    </span>
			<div class="panel-body">

				<table class="table table-striped table-bordered table-hover" id="dataTables-example" style="border-collapse: collapse">
					<thead>
						<tr>
							<th style="width: 0px;">STT</th>
							<th>Ảnh bìa</th>
							<th>Tiêu đề</th>
							<th>Tóm tắt</th>
							<th>Nội dung</th>
							<th>Ngày viết</th>
							<th>Ẩn hiện</th>
							<th>Edit</th>
							<th style="width: 63px">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($news as $new)
						<?php $stt += 1 ?>
						<tr>
							<th scope="row">{{ $stt }}</th>
							<td>
								{{ $new->alias }}
							</td>
							<td> {{ $new->title }} </td>
							<td>{{ $new->summary }}</td>
							<td>{{ $new->content}}</td>
							<td><?=date("d-m-Y h:i:s", strtotime($new->created_at));?></td>
							<form method="POST" action="{{route('admin.post.destroy', $new->id)}}">	
								<td>
									<!-- <?php
										if ($new->show_hide == 1) {
											
									?>
											<input type="checkbox" id="hide" value="{{$new->show_hide}}" onblur="showHide(this)"><span style="color:red">Ẩn</span>
									<?php 
										} else
											echo "";
									?>
 -->								</td>
								<td style="text-align: center;" class="center"><i class="fa fa-pencil fa-fw"></i><a href="{{route('admin.post.edit', $new->id)}}">Edit</a></td>
								
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input type="hidden" value="DELETE" name="_method">
									<td style="width: 75px" class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa bài viết này?')" value="Delete" /></td>
							</form>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop