@extends('admin.layouts.master2')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thông tin hóa đơn khách hàng</h1>
                    <script>window.print()</script>
                    <style>
                        @media print {
                            /* style sheet for print goes here */
                            .hide-from-printer{  display:none; }
                        }
                    </style>
                </div>
                <div class="col-md-12" style="padding-bottom:120px">
                    <tr>
                        <th>Mã hóa đơn:</th>
                        <td>{!!$order->order_no !!}</td>
                    </tr><br>
                    <tr>
                        <th>Tên khách hàng:</th>
                        <td>{!! $order->name or '<i>Không còn user này</i>'  !!}</td>
                    </tr><br>
                    <tr>
                        <th>Số điện thoại:</th>
                        <td>{!! $order->phone or '<i>Không còn user này</i>' !!}</td>
                    </tr><br>
                    <tr>
                        <th>Thời gian đặt:</th>
                        <td>
                            <?php
                            echo date("d-m-Y", strtotime($order->created_at));
                            ?>
                        </td>
                    </tr><br>
                    <tr>
                        <th>Yêu cầu khách hàng:</th>
                        <td>{!! $order->note !!}</td>
                    </tr><br>
                    @foreach($bookings as $booking)
                    <tr>
                        <th>Thời gian nhận bàn:</th>
                        <td><?=$booking->time?></td>
                    </tr><br>
                    <tr>
                        <th>Ngày nhận bàn:</th>
                        <td><?=date("d-m-Y", strtotime($booking->date))?></td>
                    </tr><br>
                    <tr>
                        <th>Khu đặt bàn:</th>
                        @if ($booking->name == 1)
                            <td><?='Khu sân vườn'?></td>
                        @elseif($booking->name == 2)
                            <td><?='Khu đại sảnh'?></td>
                        @elseif($booking->name == 3)
                            <td><?='Khu Vip'?></td>
                        @endif
                    </tr><br>
                    <tr>
                        <th>Số lượng bàn:</th>
                        <td><?=$booking->soluong?></td>
                    </tr><br>
                    @endforeach
                    <table class="table table-bordered">
                        <caption><h3>Chi tiết đơn hàng</h3></caption>
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_amount = 0;
                        $flag = true;
                        ?>
                        @foreach($combos as $k=>$combo)
                            <?php
                            if($combo->price=='') $flag = false;
                            else $total_amount += $combo->price*$combo->amount;
                            ?>
                            <tr>
                                <th>{!! $k+1 !!}</th>
                                <th>{!! $combo->name or "<font color='red'>không còn sp này</font>" !!}</th>
                                <th>{!! $combo->amount or "<font color='red'>không còn sp này</font>"!!}</th>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <hr />
                </div>
            </div>
        </div>
    </div>
@endsection