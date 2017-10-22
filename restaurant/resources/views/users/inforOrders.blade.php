@extends('layout.single2')
@section('content')
	<div class="container">
    <div class="panel panel-primary" style="margin-top: 20px;border: none;">
        <div class="panel-heading" style="height: 49px;">
            <h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Danh sách đặt bàn</h1>
        </div>
        <div class="container">
           <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="margin-left: -15px;">
              <thead>
                  <tr align="center">
                    <th style="text-align: center;">STT</th>
                    <th style="text-align: center;">Ngày tạo</th>
                    <th style="text-align: center;">Loại bàn đặt</th>
                    <th style="text-align: center;">Số lượng</th>    
                    <th style="text-align: center;">Thời gian đặt bàn</th>
                    <th style="text-align: center;">Ngày đến</th>
                    <th style="text-align: center;">Tình trạng đặt bàn</th>
                    <th style="text-align: center;">Chi tiết</th>
                    <th style="text-align: center;">Sửa</th>
                    <th style="text-align: center;width: 55px">Delete</th>
                    <th style="text-align: center;width: 55px">In</th>
                  </tr>
              </thead>
              <tbody>
                    <?php $stt = 0 ?>
                    @foreach ($booking as $booking)
                    
                    @if ($booking->user_id == Auth::User()->id)
                    <?php $stt += 1 ?>
                    <tr>
                          <td  style="text-align: center;">{!! $stt !!}</td>
                          <td  style="text-align: center;"><?=date("d-m-Y h:i:s", strtotime($booking->created_at));?></td>
                          <td style="text-align: center;">
                                <?php
                                  $data = DB::table('combo_dinings')->where('type', '=', $booking->name)->first();
                                  echo $data->name;
                                ?>
                          </td>
                          <td style="text-align: center;">{!! $booking->soluong !!}</td>
                          
                          <td style="text-align: center;">{!! $booking->time !!}</td>
                          <td style="text-align: center;"><?=date("d-m-Y", strtotime($booking->date));?>
                          </td>
                          <!-- <?php
                              $currentDate = date("Y-m-d");
                              if ($currentDate > $booking->date ){
                                  echo "<td style='text-align: center;'><font color='red'>Đặt bàn bị hủy</font></td>";                              
                              } else {
                                  if ($booking->status == 0) {
                                      echo "<td style='text-align: center;'><font>Chưa thanh toán</font></td>";
                                  }
                                  elseif ($booking->status==1) {
                                      echo "<td style='text-align: center;'><font color='orange'>Đã thanh toán</font></td>";
                                  }
                              }
                          ?> -->
                          <?php 
                              $currentDate = date("Y-m-d");
                              if ($booking->status == 1)
                                echo "<td style='text-align: center;'><font color='orange'>Đã thanh toán</font></td>";
                              else {
                                if ($currentDate > $booking->date)
                                  echo "<td style='text-align: center;'><font color='red'>Đặt bàn bị hủy</font></td>";
                                elseif ($booking->status == 0)
                                  echo "<td style='text-align: center;'><font>Chưa thanh toán</font></td>";
                              }
                          ?>
                        <td><a style="color: blue" href="{{ route('getOrderMenu', [Auth::user()->id, $booking->rand_number])}}">Xem thực đơn</a></td>
                          <?php
                              $currentDate = date("Y-m-d");
                              if ($currentDate > $booking->date || $booking->status == 1){
                                  echo "<td>&nbsp;</td>";                              
                              } else {
                                      echo "<td class='center'><i class='fa fa-pencil fa-fw'></i>
                                      <a href=".route('editBooking', $booking->id).">Sửa</a></td>";
                              }
                          ?>  
                          <form method="POST" action ="{{route('deleteBooking', [$booking->id, $booking->rand_number])}}">
                                  <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <input type="hidden" name="id" value="{!! $booking->id !!}" />
                                  <td class="center"><i class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete" onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')" value="Delete" class="butselect hvr-bounce-to-bottom" style="margin-right: 0;width: 67px" /></td>
                          </form>

                        <td><a href="{{route('printMenu', [Auth::user()->id, $booking->rand_number])}}">Print</a></td>
                    </tr> 
                    @endif  
                  @endforeach                   
              </tbody>
            </table>
        </div>
	    </div>
	</div>
@stop