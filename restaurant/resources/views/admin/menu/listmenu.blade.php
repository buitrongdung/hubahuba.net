@extends('admin.layouts.master1')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
		    <div class="col-lg-12" style="margin-bottom: -18px;">
		        <h1 class="page-header">Danh sách thực đơn
		        	<a href="{{route('admin.menu.create')}}" class="btn btn-primary">+ Tạo</a>
		        </h1>
		    </div>
		    <table style="margin-left:16px;margin-bottom: 10px;">
		        <tr>
					<td><b>Thống kê thực đơn:&nbsp;</b></td>
					<td>
						<?php 
							
							$count = DB::table('menu')->select('name','id_type')->where('id_type', '=', 1)->get();
		   						echo "<b>Khai vị:&nbsp;</b>";
		   						echo count($count);	
		   				?>
		   			</td>
		   		</tr>
		   		<tr>
		   			<td >&nbsp;</td>
					<td>
						<?php $count = DB::table('menu')->select('name','id_type')->where('id_type', '=', 2)->get();
							echo "<b>Món chính:&nbsp;</b>";
		   					echo count($count); ?>
					</td>
				</tr>
				<tr>
					<td >&nbsp;</td>
						<td> <?php $count = DB::table('menu')->select('name','id_type')->where('id_type', '=', 3)->get();
							echo "<b>Tráng miệng:&nbsp;</b>";
		   					echo count($count); ?></td>
				</tr>
				<tr>
					<td >&nbsp;</td>
						<td> <?php $count = DB::table('menu')->select('name','id_type')->where('id_type', '=', 7)->get();
							echo "<b>Đồ uống:&nbsp;</b>";
		   					echo count($count); ?></td>
				</tr>
				<tr>
					<td >&nbsp;</td>
						<td> <?php $count = DB::table('menu')->select('name','id_type')->where('id_type', '=', 9)->get();
							echo "<b>Dịch vụ:&nbsp;</b>";
		   					echo count($count); ?></td>
				</tr>
				<tr>
					<td >&nbsp;</td>
						<td> <?php $count = DB::table('menu')->select('name','id_type')->where('id_type', '=', 10)->get();
							echo "<b>Combo:&nbsp;</b>";
		   					echo count($count); ?></td>
		   		</tr>		
			</table>
			<hr>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<div id="menu" style="margin-left: -1px">
					   	<ul>
						   	<?php 
								$data = DB::table('type_menu')->select('id', 'name', 'alias')->orderBy('id')->get();

							?>
							@foreach ($data as $item)
						   		<li>
						   			<label>
						   				<a href="{!! route('admin.menu.listfood',[$item->id, $item->alias]) !!}<?=ARTICLE_SUFFIX?>">{{$item->name}}</a>
						   			</label>
						   		</li>
						   	@endforeach
					   </ul>
					</div>
					<thead>

						<tr>
							<th style="width: 0px;">STT</th>
							<th >Hình ảnh</th>
							<th>Tên SP</th>
							<th>Giá</th>
							<th style="width: 134px;">Kiểu thực đơn</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php $stt = 0 ?>
					@foreach ($menus as $menu)
						<?php $stt += 1 ?>
						<tr>
							<th scope="row">{{ $stt }}</th>
							<td style="text-align: center">
								<img style="height: 32px;width: 48px" src="{!!asset('images/menu/'.$menu->image)!!}">
							</td>
							<td>{{ $menu->name }}</td>
							<td><?php echo number_format($menu->price,0,".","."); ?> VNĐ</td>
							<td style="text-align: center;">
								@if ($menu['id_type'] == 0)
									{!! "None"!!}
								@else
									<?php
										$data = DB::table('type_menu')->where('id', $menu['id_type'])->first();
										echo $data->name;
									?>
								@endif
							</td>						
								<form method="POST" action="{{route('admin.menu.destroy',$menu['id'])}}">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input type="hidden" value="DELETE" name="_method">
									<td  class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')" value="Delete" /></td>
								</form>							
							<td style="text-align: center;" class="center"><i class="fa fa-pencil fa-fw"></i><a  href="{{route('admin.menu.edit', $menu['id'])}}">Edit</a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
			<div class="top-menu pull-left" style="margin-top: 12px">
				<ul>
					@if ($menus->currentPage() != 1)
					<li><a href="{{str_replace('/?', '?', $menus->url($menus->currentPage() - 1)) }}" style="color:black;font-size: 18px" ><i class="fa fa-backward" aria-hidden="true"></i></a></li>
					@endif
					@for ($i = 1; $i <= $menus->lastPage(); $i = $i + 1 )
					<li class="{{$menus->currentPage() == $i ? 'scroll' : ''}}" >
						<a href="{{str_replace('/?', '?', $menus->url($i)) }}" style="color:black; font-size: 18px" >{{$i}}</a>
					</li>
					@endfor
					@if ($menus->currentPage() != $menus->lastPage())
					<li><a href="{{str_replace('/?', '?', $menus->url($menus->currentPage() + 1)) }}" style="color:black;font-size: 18px" ><i class="fa fa-forward" aria-hidden="true"></i></a></li>
					@endif
				</ul>
			</div>
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
		width:149px;
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