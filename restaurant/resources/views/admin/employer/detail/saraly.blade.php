@extends('admin.layouts.master5')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lương tháng nhân viên:  
                    <?php $user = DB::table('employer')->select('name', 'email')->where('email', '=', Auth::user()->email)->first();
                    	echo "<i style='color:red'>".$user->name."</i>";
                    ?>
                    </h1>
                </div>
				<div style="float: left;">					
					<input name="_token" type="hidden" value="{!! csrf_token() !!}" />
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr align="center">
							<th>Tháng</th>
							<th>Năm</th>
							<th style="width: 46px">Ngày công chuẩn</th>
							<th>Lương cơ bản</th>
							<th>Phụ cấp</th>
							<th>Tổng thu nhập</th>
							<th style="width: 46px">Ngày công thực tế</th>
							<th>Tổng lương thực tế</th>
							<th>Khoản trừ</th>
							<th>Lương thực lĩnh</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($saraly as $item)
							<tr class="odd gradeX" align="center">
								<td> {{ $item->month }} </td>
								<td> {{ $item->year }} </td>
								<td id="NCC" class="NCC" name="NCC"> {{ $item->ngay_cong_chuan }} </td>
								<td> {!! number_format($item->luong_co_ban,0,".",".") !!} VNĐ</td>
								<td> {!! number_format($item->phu_cap,0,".",".") !!} VNĐ</td>
								<td id="TTN">
									{!! number_format($item->luong_co_ban + $item->phu_cap,0,".",".") !!} VNĐ
								</td>
								<td>

									@if (!empty($item->ngayCong))
									{{$item->ngayCong}}
									@else
                                        <?php echo "None";?>
									@endif
								</td>
								<td id="TLTT">{!! number_format(($item->luong_co_ban+$item->phu_cap)/$item->ngay_cong_chuan*$item->ngayCong,0,".",".") !!}
									VNĐ
								</td>
								<td>{!! number_format($item->khoan_tru,0,".",".") !!} VNĐ</td>
								<td id="LTL">{!! number_format(($item->luong_co_ban+$item->phu_cap)/$item->ngay_cong_chuan*$item->ngayCong-$item->khoan_tru,0,".",".") !!}
									VNĐ
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>	
@stop