@extends('admin.layouts.master2')
@section('title','Sửa hóa đơn')
@section('headerName','Sửa hóa đơn')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin thực đơn</h1>
            </div>

            <div class="col-md-12" style="padding-bottom:120px">
                  @if (isset($combos))
                  <div class="form-group">
                        <label>Mã hóa đơn</label>
                        <input class="form-control"  value="{{$order->order_no}}"  readonly />
                  </div>
                  <div class="form-group">
                        <label>Khách mua hàng</label>
                        <input class="form-control"  value="{!! $user->name or '<i>Không còn user này</i>'  !!}" readonly/>
                  </div>
                  <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control"  value="{!! $user->phone or '<i>Không còn user này</i>' !!}" readonly/>
                  </div>
                  <div class="form-group">
                        <label>Email</label>
                        <input class="form-control"  value="{!! $user->email or '<i>Không còn user này</i>'!!}" readonly/>
                  </div>
                  <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control"  value="{!! $user->address or '<i>Không còn user này</i>'!!}" readonly/>
                  </div>
                  <div class="form-group">
                        <label>Thời gian đặt hàng</label>
                        <input class="form-control" value="<?=date("d-m-Y h:i:s", strtotime($user->created_at));?>" readonly />
                  </div>
                  <div class="form-group">
                        <label>Yêu cầu của khách hàng (*)</label>
                        <textarea class="form-control" readonly>{!! $order->note !!}</textarea>
                  </div>

                  <table class="table table-bordered">
                        <caption><h3>Chi tiết thực đơn</h3></caption>
                        <thead>
                              <tr>
                                    <th>Stt</th>
                                    <th>Sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th colspan="2">Tổng tiền</th>
                              </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_amount = 0;
                        $flag = true;
                        ?>
                        @foreach($combos as $k=>$combo)
                            @if (isset($combo->rand_number))
                                <?php
                                if($combo->price=='') $flag = false;
                                else $total_amount += $combo->price*$combo->amount;
                                ?>
                              <tr>
                                    <th>{!! $k+1 !!}</th>
                                    <th>{!! $combo->name or "<font color='red'>không còn sp này</font>" !!}</th>
                                    <th><img src="{!!asset('images/menu/'.$combo->image)!!}" width="150px" height="100px" /></th>
                                    <th>{!! number_format( $combo->price,0,".",".")!!} VNĐ</th>
                                    <th>{!! $combo->amount or "<font color='red'>không còn sp này</font>"!!}</th>
                                    <th colspan="2">{!! number_format( $combo->price * $combo->amount,0,".",".")!!} VNĐ</th>
                              </tr>
                              @endif
                        @endforeach
                        </tbody>
                              <tr>
                                    <th colspan="6" align="center"><h3>Tổng tiền</h3><?php if(!$flag)echo "<font color='red'>(Lỗi)</font>" ?></th>
                                    <th><h3>{!! number_format( $total_amount,0,",",".")!!}</h3> VNĐ</th>
                              </tr>
                  </table>
                  <hr />
                  <form action="{!! route('admin.order.update',$order->id) !!}" name="frmEditOrder" method="POST">
                        <input type='hidden' name="_token" value="{!! csrf_token() !!}" />
                        <input type='hidden' name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{!! $combo->id !!}" />
                        <div class="form-group">
                              <label>Ghi chú của nhà quản trị</label>
                              <textarea class="form-control" name="ad_note">{!! $order->ad_note  !!}</textarea>
                        </div>
                        <div class="form-group">
                               <label>Tình trạng</label>
                              <label class="radio-inline">
                                  <input name="status" value="0" <?php if($combo->status==0)echo 'checked=""';  ?> type="radio">Chưa thanh toán
                              </label>
                              <label class="radio-inline">
                                  <input name="status" value="1" <?php if($combo->status==1)echo 'checked=""';  ?> type="radio"><font color="orange">Đã thanh toán</font>
                              </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật hóa đơn</button>
                  </form>
            </div>
              @else
                    Không có hóa đơn
              @endif
        </div>
    </div>
</div>
@endsection