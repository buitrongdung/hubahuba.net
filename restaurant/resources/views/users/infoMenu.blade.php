@extends('layout.single2')
@section('content')
  <div class="container">
    <div class="panel panel-primary" style="margin-top: 20px;border: none;">
      <div class="panel-heading" style="height: 49px;">
          <h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Danh sách đặt thực đơn</h1>
      </div>
      <div class="container">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="margin-left: -15px;">
            <thead>
                <tr align="center">
                  <th style="text-align: center;width: 144px;">Mã hóa đơn</th>
                  <th style="text-align: center;width: 120px;">Ngày tạo</th>
                  <th style="text-align: center;">Tên thực đơn</th>
                  <th style="text-align: center;">Hình ảnh</th>
                  <th style="text-align: center;">Giá</th>
                  <th style="text-align: center;">Số lượng</th>
                  <th style="text-align: center;">Tổng tiền</th>
                  <th style="text-align: center;">Tình trạng hóa đơn</th>
                  <th style="text-align: center;width: 55px">Delete</th>
                </tr>
            </thead>
            <tbody>
              <?php
                    $total_amount = 0;
                    $flag = true;
              ?>
              @foreach($combos as $combo)
                  @if ($combo->user_id == Auth::user()->id && isset($combo->rand_number))
              <?php
                    if($combo->price=='') $flag = false;
                    else $total_amount += $combo->price*$combo->amount;
              ?>
              <tr>
                  <td>{!! $combo->order_no !!}</td>
                  <td style="text-align: center;">{!! $combo->created_at !!}</td>
                  <td>{!! $combo->name or "<font color='red'>không còn sp này</font>" !!}</td>
                  <td><img src="{!!asset('images/menu/'.$combo->image)!!}" width="150px" height="100px" /></td>
                  <td>{!! number_format($combo->price, 0, ".", ".")!!} VNĐ</td>
                  <td style="text-align: center;">{!! $combo->amount or "<font color='red'>không còn sp này</font>"!!}</td>
                  <td>{!! number_format( $combo->price * $combo->amount,0,".",".")!!} VNĐ</td>
                  <!-- <?php
                      $currentDate = date("Y-m-d");
                      if ($currentDate > $combo->created_at ){
                          echo "<td style='text-align: center;'><font color='red'>Đặt bàn bị hủy</font></td>";                              
                      } else {
                          if ($combo->status == 0) {
                              echo "<td style='text-align: center;'><font>Chưa thanh toán</font></td>";
                          }
                          elseif ($combo->status==1) {
                              echo "<td style='text-align: center;'><font color='orange'>Đã thanh toán</font></td>";
                          }
                      }
                  ?> -->
                  <?php 
                              $currentDate = date("Y-m-d");
                              if ($combo->status == 1)
                                echo "<td style='text-align: center;'><font color='orange'>Đã thanh toán</font></td>";
                              else {
                                if ($currentDate > $combo->created_at)
                                  echo "<td style='text-align: center;'><font color='red'>Đặt bàn bị hủy</font></td>";
                                elseif ($combo->status == 0)
                                  echo "<td style='text-align: center;'><font>Chưa thanh toán</font></td>";
                              }
                          ?>
                  <form method="POST" action ="{{route('deleteOrderMenu', $combo->id)}}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}->" />
                    <input type="hidden" name="_method" value="DELETE" />
                    <input type="hidden" name="id" value="{{$combo->id}}" />
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                      <input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')" value="Delete" class="butselect hvr-bounce-to-bottom" style="margin-right:0;width:67px" />
                    </td>
                  </form>
                </tr>
              @endif
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
@stop