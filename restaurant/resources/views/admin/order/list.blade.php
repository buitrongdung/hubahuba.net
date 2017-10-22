@extends('admin.layouts.master2')
@section('title','Danh mục đơn hàng')
@section('headerName','Danh mục đơn hàng')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách hóa đơn đặt món và combo</h1>
        </div>
        <span style="margin-left: 13px"><b>Số hóa đơn thực đơn: </b> 
                <?php 
                    $user = DB::table('orders')->get();
                    echo count($user);
                ?>
        </span>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Mã hóa đơn</th>
                        <th>Tên khách hàng</th>
                        <th>Tình trạng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Giá trị đơn hàng</th>
                        <th style="width: 55px">Delete</th>
                        <th>Sửa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $k=>$order)
                        <tr class="even gradeC" align="center">
                            <td><?=$k+1?></td>
                            <td>{!! $order->order_no !!}</td>
                            <td>{!! $order->username!!}</td>
                            @if($order->status==0) 
                            <td><font>Chưa thanh toán</font></td>
                            @elseif($order->status==1) 
                            <td><font color="orange">Đã thanh toán</font></td>
                            @endif
                            <td><?=date("d-m-Y h:i:s", strtotime($order->created_at));?></td>
                            <td>{!! number_format($order->total_price,0,".",".") !!} VND</td>
                            <form method="POST" action ="{{ route('admin.order.destroy', $order->id)}}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="id" value="{!! $order->id !!}" />
                                <td  class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')" value="Delete" /></td>
                            </form>
                            @if ($order->status == 1)
                            <td>&nbsp;</td>
                                <td><a href="{{ route('orderPrint', $order->id)}}"><i class="fa fa-print" aria-hidden="true"></i>Print</a></td>
                            @elseif ($order->status == 0)
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a href="{{ route('admin.order.edit', $order->id)}}">Edit</a>
                            </td><td></td>
                            @endif

                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <a href="{{route('admin.order.unpaid')}}">Xem hóa đơn chưa thanh toán</a>
            </div>
        </div>
    </div>
</div>
@endsection