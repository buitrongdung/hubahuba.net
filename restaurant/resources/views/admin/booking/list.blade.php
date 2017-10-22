@extends('admin.layouts.master2')
@section('title','Danh mục đơn hàng')
@section('headerName','Danh mục đơn hàng')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách khách hàng đặt bàn</h1>
        </div>
        @include ('block.flash')
        <span style="margin-right: 18px;float: right"><b>Số lượng đặt bàn: </b>
            <?php
            $user = DB::table('groupbookings')->get();
            echo count($user);
            ?>
        </span>
        <div>
            <form method="post" name="showOrder" id="showOrder" action="{{route('showDetailOrder')}}">
                <div class="col-sm-4">
                    <select name="selectOrder" class="form-control">
                        <option value="0" <?php if (isset($currentDisplay) && $currentDisplay == 0) echo 'selected="selected"' ?> >Xem tất cả</option>
                        <option value="1" <?php if (isset($currentDisplay) && $currentDisplay == 1) echo 'selected="selected"' ?> >Chưa thanh toán</option>
                        <option value="2" <?php if (isset($currentDisplay) && $currentDisplay == 2) echo 'selected="selected"' ?> >Đã thanh toán</option>
                    </select>
                </div>
                <button type="submit" name="showDetailOrder" class="btn btn-primary">Xem</button>
            </form>
            <form method="post" id="showToDay" action="{{route('showDetailOrder')}}" style="margin-top: 14px">
                <div class="form-group" style="float: left">
                    <label style="margin-left: -172px;">Từ ngày</label>
                    <div class="col-sm-6" style="margin-top: 24px;width: 187px;">
                        <input type="date" name="fromDay" class="form-control" value="<?php if(isset($currentFromDay)) echo $currentFromDay ?>">
                    </div>
                </div>
                <div class="form-group" style="float: left">
                    <label style="margin-left: -172px;">Đến ngày</label>
                    <div class="col-sm-6" style="margin-top: 24px;width: 187px;">
                        <input type="date" name="toDay" class="form-control" value="<?php if(isset($currentToDay)) echo $currentToDay ?>">
                    </div>
                </div>
                <button type="submit" name="showToDay" class="btn btn-primary" style="margin-top: 24px">Xem ngày nhận bàn</button>
            </form>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Ngày đặt bàn</th>
                        <th>Tên khách hàng</th>
                        <th>Đặt khu</th>
                        <th>SL bàn</th>
                        <th>Thời gian đến</th>
                        <th>Ngày nhận bàn</th>
                        <th>Tình trạng</th>
                        <th>Chi tiết</th>
                        <th style="width: 55px">Delete</th>
                        <th>Sửa</th>
                        <th>In</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($bookings))
                    @foreach($bookings as $k=>$booking)
                        <tr id="showOrderToSelected" class="even gradeC" align="center">
                            <td>{!! $k+1 !!}</td>
                            <td>
                                <?php
                                echo date("d-m-Y", strtotime($booking->created_at));
                                ?>
                            </td>
                            <td>
                            <?php 
                                $user = DB::table('users')->select()->where('id', $booking->user_id)->first();
                                echo $user->name;
                            ?>
                            </td>
                            <td>
                            <?php $comboDining = DB::table('combo_dinings')->select()->where('id', $booking->name)->first();
                                echo $comboDining->name;
                            ?>
                            </td>
                            <td>{{$booking->soluong}}</td>
                            <td>{!! $booking->time !!}</td>
                            <td>
                                <?php
                                echo date("d-m-Y", strtotime($booking->date));
                                ?>
                            </td>
                            <?php
                                $currentDate = date("Y-m-d");
                                if ($currentDate > $booking->date ){
                                    echo "<td><font color='red'>Đặt bàn bị hủy</font></td>";                              
                                } else {
                                    if ($booking->status == 0) {
                                        echo "<td><font>Chưa nhận bàn</font></td>";
                                    }
                                    elseif ($booking->status == 1) {
                                        echo "<td><font color='orange'>Đã nhận bàn</font></td>";
                                    }
                                }
                            ?>
                            <td style="width: 0px;text-align: center;">
                                <a style="color: blue;font-size: 16px" href="{{ route('admin.order.edit', [$booking->user_id, $booking->rand_number])}}">
                                    <i class="fa fa-search-plus" aria-hidden="true"> Xem hóa đơn	</i>
                                </a>
                            </td>
                            <form method="POST" action ="{{ route('admin.booking.destroy', [$booking->id, $booking->rand_number])}}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="id" value="{!! $booking->id !!}" />
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa bàn đặt này?')" value="Delete" /></td>
                            </form>
                            <?php
                                $currentDate = date("Y-m-d");
                                if ($currentDate > $booking->date || $booking->status == 1){
                                    echo "<td>&nbsp;</td>";                              
                                } else {
                                        echo "<td class='center'><i class='fa fa-pencil fa-fw'></i><a href=".route('admin.booking.edit', $booking->id).">Edit</a></td>";
                                }
                            ?>
                            <td><a href="{{ route('orderPrint', [$booking->user_id, $booking->rand_number])}}"><i class="fa fa-print" aria-hidden="true"></i>Print</a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
    <script type="text/javascript" src="{{url('admin/js/showOrder.js')}}"></script>
@endsection