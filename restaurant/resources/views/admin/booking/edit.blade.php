

    @extends('admin.layouts.master2')

@section('title','Sửa hóa đơn')
@section('headerName','Sửa hóa đơn')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa thông tin đặt bàn</h1>
            </div>
            <div class="col-md-12" style="padding-bottom:120px">
              <div class="form-group">
                    <label>Mã khách hàng</label>
                    <input class="form-control"  value="{!! $users->id !!}"  readonly />
              </div>
              <div class="form-group">
                    <label>Khách mua hàng</label>
                    <input class="form-control"  value="{!! $users->name !!}" readonly/>
              </div>
              <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control"  value="{!! $users->phone !!}" readonly/>
              </div>
              <div class="form-group">
                    <label>Email</label>
                    <input class="form-control"  value="{!! $users->email !!}" readonly/>
              </div>
              <div class="form-group">
                    <label>Địa chỉ</label>
                    <input class="form-control"  value="{!! $users->address !!}" readonly/>
              </div>
              <form action="{!! route('admin.booking.update',$booking->id) !!}" name="frmEditOrder" method="POST">
                <table class="table table-bordered">
                  <caption><h3>Chi tiết đặt bàn</h3></caption>
                  <thead>
                        <tr>
                              <th>Loại bàn đặt</th>
                              <th>Số lượng</th>
                              <th>Thời gian đặt bàn</th>
                              <th>Ngày đặt bàn</th>
                        </tr>
                  </thead>
                  <tbody>
                        <tr>
                            <td style="text-align: center;">
                              <select class="form-control" name="name" id="name">                                               
                              <?php
                                  $data = DB::table('combo_dinings')->where('type', $booking->name)->first();
                                  echo "<option style='color:red'>".$data->name."</option>";
                              ?>
                              @foreach($dinings as $dining)
                              <option value="{{$dining->type}}">{{$dining->name}}</option>
                              @endforeach
                              </select>
                            </td>
                            <td>
                                <select class="form-control" name="soluong" id="soluong">
                                <option>{{$booking->soluong}}</option>
                                <?php
                                    for ($i = 1; $i <= 10; $i++)
                                        echo "<option value=".$i.">".$i."</option>";
                                ?>
                                </select>
                            </td>                                                       
                            <td>
                              <p>
                                <div class="form-right">
                                    <label class="col-sm-5 control-label" style="width: 139px">
                                        <i class=" glyphicon glyphicon-time"></i> Thời gian :
                                    </label>
                                    <div class="col-sm-6" style="margin-left: -36px;margin-top: -6px;">
                                    <input  type="time" name="time" id="time" value="{{$booking->time}}" class="form-control">
                                    </div>
                                </div>
                              </p>
                            </td>
                            <td>
                                <p>
                                    <div class="form-left">
                                        <label class="col-sm-4 control-label"><i class="glyphicon glyphicon-calendar"></i> Ngày :</label>
                                        <div class="col-sm-7" style="margin-left: -36px;margin-top: -6px;">
                                            <input type="date" id="date" name="date" value="{{$booking->date}}" class="form-control">
                                        </div>
                                    </div>
                                </p>
                            </td>     
                        </tr>                      
                  </tbody>
                </table>
                <hr />
                <input type='hidden' name="_token" value="{!! csrf_token() !!}" />
                <input type='hidden' name="_method" value="PUT" />
                <input type="hidden" name="id" value="{!! $booking->id !!}" />
                <div class="form-group">
                      <label>Ghi chú của nhà quản trị</label>
                      <textarea class="form-control" name="ad_note">{!! $booking->ad_note  !!}</textarea>
                </div>
                <div class="form-group">
                       <label>Tình trạng hóa đơn</label>
                      <label class="radio-inline">
                          <input name="status" value="0" <?php if($booking->status==0)echo 'checked=""';  ?> type="radio">Chưa nhận bàn
                      </label>
                      <label class="radio-inline">
                          <input name="status" value="1" <?php if($booking->status==1)echo 'checked=""';  ?> type="radio"><font color="orange">Đã nhận bàn</font>
                      </label>
                </div>
                <button type="submit" class="btn btn-primary" name="editOrder">Cập nhật</button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection