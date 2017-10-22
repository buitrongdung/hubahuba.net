
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thông tin hóa đơn khách hàng</h1>
                    <hr />
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
                        <td style="text-transform: uppercase;">{!! Auth::user()->name !!}</td>
                    </tr><br>
                    <tr>
                        <th>Số điện thoại:</th>
                        <td>{!! Auth::user()->phone !!}</td>
                    </tr><br>
                    <tr>
                        <th>Thời gian đặt hàng:</th>
                        <td><?=date("d-m-Y h:i:s", strtotime($order->created_at));?></td>
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
                        <th>Loại bàn:</th>
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
                            <th>Tên SP</th>
                            <th>SL</th>
                            <th>Giá (VNĐ)</th>
                            <th>Thành tiền (VNĐ)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_amount = 0;
                        $flag = true;
                        ?>
                        @foreach($combos as $k=>$combo)
                            @if ($combo->user_id == Auth::user()->id && isset($combo->rand_number))
                                <?php
                                if($combo->price=='') $flag = false;
                                else $total_amount += $combo->price*$combo->amount;
                                ?>
                                <tr>
                                    <th>{!! $k+1 !!}</th>
                                    <td>{!! $combo->name or "<font color='red'>không còn sp này</font>" !!}</td>
                                    <td style="text-align: center;">{!! $combo->amount or "<font color='red'>không còn sp này</font>"!!}</td>
                                    <td>{!! number_format($combo->price, 0, ".", ".")!!}</td>
                                    <td>{!! number_format( $combo->price * $combo->amount,0,".",".")!!}</td>

                                </tr>

                            @endif
                        @endforeach
                        <tr>
                            <th colspan="4">Tổng tiền :</th>
                            <th id="totalAmount"><?=number_format($total_amount, 0, ".", ".")?></th>
                        </tr>

                        </tbody>
                    </table>
                    <hr />
                </div>
            </div>
        </div>
    </div>
