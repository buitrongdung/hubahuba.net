@extends('layout.single2')
@section('content')
    <div class="container">
        @include ('block.flash')
        <div class="panel panel-primary" style="margin-top: 20px;height: 268px;">
            <div class="panel-heading">
                <h1 class="tittle wow bounceIn panel-title"  data-wow-duration=".8s" data-wow-delay=".2s" style="font-size: 37px;text-align: center;">Vui lòng điền thông tin dưới đây</h1>
            </div>
            <div class="container">
            <form action="{{route('updateBooking', $booking->id)}}" method="post" style="margin-top: 20px;width: 1107px;">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="error-message"></div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="c1">   
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" style="">
                                <thead>
                                    <tr>
                                    <th style="text-align: center;">Loại Bàn</th>
                                    <th style="text-align: center;">Số lượng bàn <br/>(click chọn)</th>
                                    <th style="text-align: center;">Thời gian (Chọn giờ)</th>
                                    <th style="text-align: center;">Thời gian (Chọn ngày)</th>
                                    </tr>
                                </thead>
                                <tbody>                                                  
                                    <tr>                                              
                                        <td>
                                            <select class="form-control" name="name" id="name">                                               
                                                  <?php
                                                      $data = DB::table('combo_dinings')->where('type', $booking->name)->first();
                                                      echo "<option style='color:red' value='".$data->type."'>".$data->name."</option>";
                                                  ?>
                                                  @foreach($dinings as $dining)
                                                  <option value="{{$dining->type}}">{{$dining->name}}</option>
                                                  @endforeach
                                            </select>
                                        </td>                                                      
                                        <td>
                                            <select class="form-control" name="soluong" id="soluong"> 
                                            <?php
                                                for ($i = 1; $i <= 10; $i++)
                                                    echo "<option value=".$i.">".$i."</option>";
                                            ?>
                                            </select>
                                        </td>                                                       
                                        <td>
                                            <p>
                                                <div class="form-right">
                                                    <label class="col-sm-5 control-label" style="width: 139px;margin-top: 6px">
                                                        <i class=" glyphicon glyphicon-time"></i> Thời gian :
                                                    </label>
                                                    <div class="col-sm-6" style="margin-left: -16px">
                                                    <input  type="time" name="time" id="time" value="{{$booking->time}}" class="form-control">
                                                    </div>
                                                </div>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <div class="form-left">
                                                    <label class="col-sm-4 control-label" style="margin-top: 6px"><i class="glyphicon glyphicon-calendar"></i> Ngày :</label>
                                                    <div class="col-sm-7" style="margin-left: -32px">
                                                        <input type="date" id="date" name="date" value="{{$booking->date}}" class="form-control">
                                                    </div>
                                                </div>
                                            </p>
                                        </td>                                                  
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>                 
                    </div>
                </fieldset>
                <button style="background-color:#EFA52C; border:none;float: right;margin-right: 101px;width: 106px;margin-top: -3px;" class="butselect hvr-bounce-to-bottom" type="đặt bàn" name="editBooking">Cập nhật</button>
            </form>     
            </div>        
        </div>
    </div>
@stop